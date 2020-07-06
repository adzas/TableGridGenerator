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
        $this->getHead();
        $this->getContent($rows);
        $this->getNavigation();
    }

    public function getHead(): void
    {
        $this->getStartTable();
        ?>
            <thead>
                <tr>
                    <?php foreach ($this->columns as $head): ?>
                        <th><?=$head->getLabel();?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
        <?php
    }

    public function getNavigation(): void
    {
        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        <?php
        $this->getEndTable();
    }

    public function getContent(array $rows)
    {
        if($this->httpState->getRowsPerPage() < count($rows)) {
            $rowsCount = $this->httpState->getRowsPerPage();
        } else {
            $rowsCount = count($rows);
        }
        ?>
            <tbody>
                <?php for ($i = 0; $i < $rowsCount; $i++): ?>
                <tr>
                    <?=$this->generateRow($rows[$i]);?>
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
                echo '<td>';
                $colGrid = $this->getColumns($j);
                if ($colGrid) {
                    $dataType = $colGrid->getDataType();
                    echo $dataType->format($col);
                }
                echo '</td>';
            }
            $j++;
        }
    }

    public function getColumns(int $i)
    {
        if (!isset($this->columns[$i])) {
            Alert::warning();
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