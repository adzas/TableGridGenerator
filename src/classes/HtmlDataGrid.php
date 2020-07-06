<?php

namespace MyLib\Classes;
use MyLib\Interfaces\DataGrid;

class HtmlDataGrid implements DataGrid
{
    protected $columns;
    protected $httpState;

    public function withConfig(DefaultConfig $config): HtmlDataGrid
    {
        //tutaj w parametrze przychodzi konfiguracja tabeli
        $this->columns = $config->getColumns();
        return $this;
    }

    public function setState(httpState $state)
    {
        $this->httpState = $state;
    }

    public function render(array $rows, HttpState $state): void
    {
        $this->setState($state);
        $this->getStartTable();
        $this->getHead($rows[0]);
        $this->getContent($rows);
        $this->getEndTable();
        $this->getNavigation(count($rows));
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
                            <?=$rows_keys[$k] == $this->httpState->getOrderBy() ? 
                            $this->httpState->getOrderDescIcon() : 
                            '';?>
                        </a>
                    </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
        <?php
    }

    public function getNavigation(int $howMuchRows): void
    {
        if ($howMuchRows <= $this->httpState->getRowsPerPage()) {
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
                    <li class="page-item <?=$this->httpState->getCurrentPage() == ($countPage - 1) ? 'disabled' : '';?>">
                        <a class="page-link" href="<?=$this->generatePageChangeLink($this->httpState->getCurrentPage() + 1);?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php
    }

    public function generatePageChangeLink(int $page)
    {
        return '?page=' . $page . '&sort=' . $this->httpState->getOrderBy();
    }

    public function generateSortChangeLink(string $sort)
    {
        return '?page=' . $this->httpState->getCurrentPAge() . '&sort=' . $sort;
    }

    private function buildSorter($key) {
        return function ($a, $b) use ($key) {
            return $a[$key] <=> $b[$key];
        };
    }

    public function getContent(array $rows)
    {
        usort($rows, $this->buildSorter($this->httpState->getOrderBy()));

        if($this->httpState->getRowsPerPage() < count($rows)) {
            $rowsCount = $this->httpState->getRowsPerPage();
        } else {
            $rowsCount = count($rows);
        }

        $startCount = $this->httpState->getRowsPerPage() * $this->httpState->getCurrentPage();
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

    public function generateRow(array $row)
    {
        $j = 0;
        foreach ($row as $col) {
            if($j <= count($this->columns)) {
                $colGrid = $this->getColumns($j);
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

    public function getColumns(int $i)
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