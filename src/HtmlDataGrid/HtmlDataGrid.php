<?php

namespace MyLib\HtmlDataGrid;

class HtmlDataGrid
{
    public function withConfig()
    {
        return $this;
    }

    public function render($data): string {
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
                <tbody>
                <tr><td style="text-align: right;">1</td><td>Celina Collins</td><td style="text-align: right;">23</td><td>NETBOOK</td><td style="text-align: right;">3 055,76 USD</td><td>+1 (855) 514-2949</td><td>celinacollins@netbook.com</td></tr><tr><td style="text-align: right;">2</td><td>Brock Adams</td><td style="text-align: right;">36</td><td>EWAVES</td><td style="text-align: right;">3 324,40 USD</td><td>+1 (988) 489-3691</td><td>brockadams@ewaves.com</td></tr><tr><td style="text-align: right;">3</td><td>Augusta Mccarty</td><td style="text-align: right;">23</td><td>SONGBIRD</td><td style="text-align: right;">3 266,87 USD</td><td>+1 (987) 470-3284</td><td>augustamccarty@songbird.com</td></tr><tr><td style="text-align: right;">4</td><td>Beasley Rocha</td><td style="text-align: right;">30</td><td>MARKETOID</td><td style="text-align: right;">2 670,30 USD</td><td>+1 (845) 429-2442</td><td>beasleyrocha@marketoid.com</td></tr><tr><td style="text-align: right;">5</td><td>Hayes Peters</td><td style="text-align: right;">25</td><td>QUILCH</td><td style="text-align: right;">3 164,32 USD</td><td>+1 (843) 491-2707</td><td>hayespeters@quilch.com</td></tr><tr><td style="text-align: right;">6</td><td>Cotton Vincent</td><td style="text-align: right;">34</td><td>NEPTIDE</td><td style="text-align: right;">3 582,82 USD</td><td>+1 (956) 575-2083</td><td>cottonvincent@neptide.com</td></tr><tr><td style="text-align: right;">7</td><td>Williams Bradshaw</td><td style="text-align: right;">25</td><td>BOLAX</td><td style="text-align: right;">3 823,66 USD</td><td>+1 (971) 531-2436</td><td>williamsbradshaw@bolax.com</td></tr><tr><td style="text-align: right;">8</td><td>Holcomb Chan</td><td style="text-align: right;">35</td><td>ANIVET</td><td style="text-align: right;">3 054,39 USD</td><td>+1 (877) 523-3680</td><td>holcombchan@anivet.com</td></tr><tr><td style="text-align: right;">9</td><td>Mabel Boyd</td><td style="text-align: right;">31</td><td>ZILLANET</td><td style="text-align: right;">2 018,92 USD</td><td>+1 (979) 552-3369</td><td>mabelboyd@zillanet.com</td></tr>            </tbody>
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
        return $html;
    }
}