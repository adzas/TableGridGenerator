<?php

namespace MyLib\Classes;
use MyLib\Interfaces\DataGrid;

class HtmlDataGrid implements DataGrid
{
    protected $config;

    public function withConfig(DefaultConfig $config): HtmlDataGrid
    {
        //tutaj w parametrze przychodzi konfiguracja tabeli
        $this->config = $config->getColumns();
        return $this;
    }

    public function render(array $rows, HttpState $state): void
    {
        $html = '
        <div class="example">
            <table class="table table-bordered">
                <thead>
                <tr>';
                foreach ($this->config as $head) {

                    $html.= "<th>" . $head->getLabel() . "</th>";
                }
        $html.= '</tr>
                </thead>
                <tbody>';
                foreach ($rows as $val) {
                    $html.='
                    <tr>
                        <td style="text-align: right;">' . $val['id'] . '</td>
                        <td>' . ($this->config[1]->getDataType())->format($val['name']) . '</td>
                        <td style="text-align: right;">' . $val['age'] . '</td>
                        <td>' . ($this->config[3]->getDataType())->format($val['company']) . '</td>
                        <td style="text-align: right;">' . ($this->config[4]->getDataType())->format($val['balance']) . ' USD</td>
                        <td>' . $val['phone'] . '</td>
                        <td>' . $val['email'] . '</td>
                    </tr>';
                }
                
                $html.= '</tbody>
            </table>

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
        </div>
        ';
        echo $html;
    }
}