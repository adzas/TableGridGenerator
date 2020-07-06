<?php

namespace MyLib\Classes;
use MyLib\Interfaces\DataGrid;

class HtmlDataGrid implements DataGrid
{
    protected $columns;
    protected $httpState;
    protected $dataKey;

    public function withConfig(DefaultConfig $config): HtmlDataGrid
    {
        //tutaj w parametrze przychodzi konfiguracja tabeli
        $this->columns = $config->getColumns();
        return $this;
    }

    public function setState(HttpState $state)
    {
        $this->httpState = $state;
    }

    public function render($rows, HttpState $state): void
    {
        if (!is_array($rows) || empty($rows)) {
            Alert::fatal('no data');
        } else {
            if (count($this->columns) != count(array_keys($rows[0]))) {
                Alert::fatal('Config Column Error');
            } else {
                $this->setState($state);
                $this->getStartTable();
                $this->getHead($rows[0]);
                $this->getContent($rows);
                $this->getEndTable();
                $this->getNavigation(count($rows));
            }
        }
    }

    public function getHead(array $row): void
    {
        $rows_keys = array_keys($row);
        ?>
            <thead>
                <tr>
                    <?php foreach ($this->columns as $k => $head): ?>
                    <th>
                        <a href="<?=$this->generateSortChangeLink($rows_keys[$k]);?>">
                            <?=$head->getLabel();?>
                            <?=$this->getIconSort($rows_keys[$k]);?>
                        </a>
                    </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
        <?php
    }

    public function getIconSort(string $key)
    {
        if ($key == $this->httpState->getOrderBy()) {
            if ($this->httpState->isOrderDesc()) {
                return $this->httpState->getOrderDescIcon();
            } elseif ($this->httpState->isOrderAsc()) {
                return $this->httpState->getOrderAscIcon();
            }
        }
    }

    public function getNavigation(int $howMuchRows): void
    {
        if ($howMuchRows == 1) {
            $countPage = 0;
            $oneMore = 1;
        } elseif ($howMuchRows <= $this->httpState->getRowsPerPage()) {
            $countPage = 1;
            $oneMore = 0;
        } else {
            $countPage = round($howMuchRows / $this->httpState->getRowsPerPage());
            if (!!($howMuchRows % $this->httpState->getRowsPerPage())) {
                $oneMore = 1;
            } else {
                $oneMore = 0;
            }
        }

        ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?=$this->httpState->getCurrentPage() == 0 ? 'disabled' : '';?>">
                        <a class="page-link" href="<?=$this->generatePageChangeLink($this->httpState->getCurrentPage() - 1);?>" tabindex="-1">Previous</a>
                    </li>
                    <?php for ($i=0; $i < ($countPage + $oneMore); $i++): ?>
                        <li class="page-item <?=$this->httpState->getCurrentPage() == $i ? 'active' : '';?>">
                            <a class="page-link" href="<?=$this->generatePageChangeLink($i);?>"><?=$i + 1;?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?=$this->httpState->getCurrentPage() == $countPage ? 'disabled' : '';?>">
                        <a class="page-link" href="<?=$this->generatePageChangeLink($this->httpState->getCurrentPage() + 1);?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php
    }

    public function generatePageChangeLink(int $page)
    {
        if ($this->httpState->isOrderDesc()) {
            return '?page=' . $page . '&sortDesc=' . $this->httpState->getOrderBy();
        } elseif ($this->httpState->isOrderAsc()) {
            return '?page=' . $page . '&sortAsc=' . $this->httpState->getOrderBy();
        } else {
            return '?page=' . $page . '&sortDesc=' . $this->httpState->getOrderBy();
        }
    }

    public function generateSortChangeLink(string $sort)
    {
        if (!$this->httpState->isOrderDesc() && !$this->httpState->isOrderAsc()) {
            return '?page=' . $this->httpState->getCurrentPage() . '&sortDesc=' . $sort;
        }
        
        if (empty($this->httpState->getOrderBy())) {
            return '?page=' . $this->httpState->getCurrentPage() . '&sortDesc=' . $sort;
        }
        
        if ($this->httpState->getOrderBy() == $sort) {
            if ($this->httpState->isOrderDesc()) {
                return '?page=' . $this->httpState->getCurrentPage() . '&sortAsc=' . $sort;
            } elseif ($this->httpState->isOrderAsc()) {
                return '?page=' . $this->httpState->getCurrentPage();
            } else {
                return '?page=' . $this->httpState->getCurrentPage() . '&sortDesc=' . $sort;
            }
        } else {
            return '?page=' . $this->httpState->getCurrentPage() . '&sortDesc=' . $sort;
        }
    }

    private function buildSorterDesc($key) {
        return function ($a, $b) use ($key) {
            return $a[$key] <=> $b[$key];
        };
    }

    private function buildSorterAsc($key) {
        return function ($a, $b) use ($key) {
            return $b[$key] <=> $a[$key];
        };
    }

    /**
     * Sortuje dane po odpowiedzniej kolumnie
     */
    public function dataSort(array $rows)
    {
        if ($this->httpState->isOrderDesc()) {
            usort($rows, $this->buildSorterDesc($this->httpState->getOrderBy()));
        } elseif ($this->httpState->isOrderAsc()) {
            usort($rows, $this->buildSorterAsc($this->httpState->getOrderBy()));
        }
        return $rows;
    }

    /**
     * Oblicza ile ma wyświetlić stron
     */
    public function checkRowsPerPage(array $rows)
    {
        if($this->httpState->getRowsPerPage() < count($rows)) {
            return $this->httpState->getRowsPerPage();
        } else {
            return count($rows);
        }
    }

    /**
     * ustala od którego numeru id wyświetlać dane
     */
    public function countTo()
    {
        return $this->httpState->getRowsPerPage() * $this->httpState->getCurrentPage();
    }

    /**
     * Ustawia schemat kluczy na podstawie pierwszego wiersza danych
     */
    public function setBasicFrameKey(array $row): void
    {
        $this->dataKey = array_keys($row);
    }

    /**
     * Wyświetla kontent tabeli
     */
    public function getContent(array $rows)
    {
        $rows = $this->dataSort($rows);

        $rowsCount = $this->checkRowsPerPage($rows);

        $startCount = $this->countTo();

        $this->setBasicFrameKey($rows[0]);
        
        ?>
            <tbody>
                <?php for ($i = $startCount; $i < ($rowsCount + $startCount); $i++): ?>
                <tr>
                    <?=!empty($rows[$i]) ? $this->generateRow($rows[$i]) : '';?>
                </tr>
                <?php endfor; ?>
            </tbody>
        <?php
    }

    /**
     * generuje pojedynczą linikję tabeli
     */
    public function generateRow(array $row)
    {
        if ($this->dataKey !== array_keys($row)) {
            echo '<td colspan="' . count($row) . '" style="text-align: center">';
            Alert::fatal('Błędny klucz danych');
            echo '</td>';
        } else {
            $j = 0;
            foreach ($row as $col) {
                if($j <= count($this->columns)) {
                    $colGrid = $this->getColumn($j);
                    if ($colGrid) {
                        echo '<td style="text-align: ' . $colGrid->getAlign() . '">';
                        echo ($colGrid->getDataType())->format($col);
                        echo '</td>';
                    } else {
                        echo '<td>';
                        echo Alert::warning('Error configuration column');
                        echo '</td>';
                    }
                }
                $j++;
            }
        }
    }

    /**
     * generuje kolumnę główną HEAD dla zadajen kolumnie
     */
    public function getColumn(int $i)
    {
        if (!isset($this->columns[$i])) {
            return false;
        } else {
            return $this->columns[$i];
        }
    }

    public function getStartTable(): void
    {
        echo '<table class="table table-bordered">';
    }

    public function getEndTable(): void
    {
        echo '</table>';
    }
}