<?php
include_once 'layout-head.php';
?>

<div class="personal-timetable active">
    <div class="flex--column section-header">
        <span class="header">Your Timetable 📅</span>
    </div>
    <div class="flex--row content-wrapper">
        <div class="flex--column wrapper--left">
            <div class="content-box periods">
                <div class="flex--row box--header period-index">
                    <span id="period-counter">Period (1/6)</span>
                    <div id="period-select">
                        <img src="./assets/img/period-arrow-left.png" class="period-arrow" alt="left arrow"
                            onclick="changePeriod('prev')">
                        <img src="./assets/img/period-arrow-right.png" class="period-arrow" alt="right arrow"
                            onclick="changePeriod('next')">
                    </div>
                </div>
                <div class="flex--row period-content">

                </div>
            </div>
            <div class="content-box timetable-courses">
                <div class="flex--row box--header period-index">
                    <span>Courses</span>
                    <img src="./assets/img/student-icon.png" class="period-arrow" alt="left arrow">
                </div>
                <div class="flex--row courses-content">
                    <div>
                        <input type="checkbox" class="course" name="PAV" value="" checked>
                        <label for="123124">Academische Vaardigheden KI jaar 1</label>
                        <div>
                            <input type="checkbox" class="course" name="WEB" value="" checked>
                            <label for="123124">Webtechnologie voor KI/INF</label>
                        </div>
                        <div>
                            <input type="checkbox" class="course" name="PSS" value="" checked>
                            <label for="123124">
                                Problem Solving and Search/label>
                                <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex--column wrapper--right">
            <div class="flex--column gap-5">
                <div class="flex--row calendar-header">
                    <div id="period-indicator">
                        Period 1
                    </div>
                    <div id="week-indicator">
                        Week 36
                    </div>
                </div>
                <div class="flex--row calendar-header">
                    <div id="week-days-indicator">
                        5 September - 9 September
                    </div>
                    <div id="year-indicator">
                        2023
                    </div>
                </div>
            </div>
            <div class="content-box calendar">
                <table style="width:100%; border-collapse: collapse;">
                    <tr id="calendar-date-headers">
                        <th>
                            <div class="text">
                                <span id="day">
                                    monday
                                </span>
                                <span id="date">
                                    5 sept
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="text">
                                <span id="day">
                                    tuesday
                                </span>
                                <span id="date">
                                    6 sept
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="text">
                                <span id="day">
                                    wednesday
                                </span>
                                <span id="date">
                                    7 sept
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="text">
                                <span id="day">
                                    thursday
                                </span>
                                <span id="date">
                                    8 sept
                                </span>
                            </div>
                        </th>
                        <th>
                            <div class="text">
                                <span id="day">
                                    friday
                                </span>
                                <span id="date">
                                    9 sept
                                </span>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>


                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include_once 'layout-foot.php';
?>