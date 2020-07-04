<?php

namespace MyLib\Classes;
use MyLib\Interfaces\DataGrid;

class HtmlDataGrid implements DataGrid
{
    public function withConfig(DefaultConfig $config): HtmlDataGrid
    {
        //tutaj w parametrze przychodzi konfiguracja tabeli
        return $this;
    }

    public function render(array $rows, HttpState $state): void
    {
        $html = '
        <div class="example">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Company</th>
                    <th>Balance</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>';
                foreach ($rows as $val) {
                    $html.='
                    <tr>
                        <td style="text-align: right;">' . $val['id'] . '</td>
                        <td>' . $val['name'] . '</td>
                        <td style="text-align: right;">' . $val['age'] . '</td>
                        <td>' . $val['company'] . '</td>
                        <td style="text-align: right;">' . $val['balance'] . ' USD</td>
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