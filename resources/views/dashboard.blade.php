@extends('layouts.body_structer')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card card-widget widget-user h-100">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-primary">
              <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
              <h5 class="widget-user-desc">مرحبا بك</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle elevation-2 h-100" src="{{ asset('images/high.jpg') }}" alt="Logo">
            </div>
            <div class="card-footer h-100">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $season->name }} {{ $season->created_at->format('Y') }}</h5>
                    <span class="description-text">الفصل الحالي</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ count($sections) }}</h5>
                    <span class="description-text">عدد الاقسام</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{ count($teachers) }}</h5>
                    <span class="description-text">عدد المدرسين</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
    </div>
    <div class="col-sm-6">
        <div class="card bg-gradient-secondary h-100" style="position: relative; left: 0px; top: 0px;">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

              <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                التقويم
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body pt-0">
              <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">October 2024</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="09/29/2024" class="day old weekend">29</td><td data-action="selectDay" data-day="09/30/2024" class="day old">30</td><td data-action="selectDay" data-day="10/01/2024" class="day">1</td><td data-action="selectDay" data-day="10/02/2024" class="day">2</td><td data-action="selectDay" data-day="10/03/2024" class="day">3</td><td data-action="selectDay" data-day="10/04/2024" class="day">4</td><td data-action="selectDay" data-day="10/05/2024" class="day weekend">5</td></tr><tr><td data-action="selectDay" data-day="10/06/2024" class="day weekend">6</td><td data-action="selectDay" data-day="10/07/2024" class="day">7</td><td data-action="selectDay" data-day="10/08/2024" class="day">8</td><td data-action="selectDay" data-day="10/09/2024" class="day">9</td><td data-action="selectDay" data-day="10/10/2024" class="day">10</td><td data-action="selectDay" data-day="10/11/2024" class="day">11</td><td data-action="selectDay" data-day="10/12/2024" class="day weekend">12</td></tr><tr><td data-action="selectDay" data-day="10/13/2024" class="day weekend">13</td><td data-action="selectDay" data-day="10/14/2024" class="day">14</td><td data-action="selectDay" data-day="10/15/2024" class="day">15</td><td data-action="selectDay" data-day="10/16/2024" class="day active today">16</td><td data-action="selectDay" data-day="10/17/2024" class="day">17</td><td data-action="selectDay" data-day="10/18/2024" class="day">18</td><td data-action="selectDay" data-day="10/19/2024" class="day weekend">19</td></tr><tr><td data-action="selectDay" data-day="10/20/2024" class="day weekend">20</td><td data-action="selectDay" data-day="10/21/2024" class="day">21</td><td data-action="selectDay" data-day="10/22/2024" class="day">22</td><td data-action="selectDay" data-day="10/23/2024" class="day">23</td><td data-action="selectDay" data-day="10/24/2024" class="day">24</td><td data-action="selectDay" data-day="10/25/2024" class="day">25</td><td data-action="selectDay" data-day="10/26/2024" class="day weekend">26</td></tr><tr><td data-action="selectDay" data-day="10/27/2024" class="day weekend">27</td><td data-action="selectDay" data-day="10/28/2024" class="day">28</td><td data-action="selectDay" data-day="10/29/2024" class="day">29</td><td data-action="selectDay" data-day="10/30/2024" class="day">30</td><td data-action="selectDay" data-day="10/31/2024" class="day">31</td><td data-action="selectDay" data-day="11/01/2024" class="day new">1</td><td data-action="selectDay" data-day="11/02/2024" class="day new weekend">2</td></tr><tr><td data-action="selectDay" data-day="11/03/2024" class="day new weekend">3</td><td data-action="selectDay" data-day="11/04/2024" class="day new">4</td><td data-action="selectDay" data-day="11/05/2024" class="day new">5</td><td data-action="selectDay" data-day="11/06/2024" class="day new">6</td><td data-action="selectDay" data-day="11/07/2024" class="day new">7</td><td data-action="selectDay" data-day="11/08/2024" class="day new">8</td><td data-action="selectDay" data-day="11/09/2024" class="day new weekend">9</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2024</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month active">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year active">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
            </div>
        </div>
    </div>
</div>

@endsection
