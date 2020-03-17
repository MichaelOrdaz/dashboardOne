<div class="content ht-100v pd-0">
      <div class="content-header justify-content-end">
        <!-- <div class="content-search">
          <i data-feather="search"></i>
          <input type="search" class="form-control" placeholder="Search...">
        </div> -->
        <nav class="nav">
          <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
          <!-- <a href="" class="nav-link"><i data-feather="grid"></i></a> -->
          <a href="" class="nav-link"><i data-feather="log-out"></i></a>
        </nav>
      </div><!-- content-header -->

      <div class="content-body">
        <div class="container pd-x-0">
          <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#"> <?= $breadcrumbMain ?> </a></li>
                  <li class="breadcrumb-item active" aria-current="page"> <?= $breadcrumbSecondary ?> </li>
                </ol>
              </nav>
              <h4 class="mg-b-0 tx-spacing--1">Bienvenido al Dashboard</h4>
            </div>
            <div class="d-none d-md-block">
              <!-- <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i data-feather="printer" class="wd-10 mg-r-5"></i> Print</button> -->
              <!-- <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file" class="wd-10 mg-r-5"></i> Generate Report</button> -->
            </div>
          </div>

          <div class="row row-xs">
            <div class="col-sm-6 col-lg-3">
              <div class="card card-body">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Conversion Rate</h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">0.81%</h3>
                  <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">1.2% <i class="icon ion-md-arrow-up"></i></span></p>
                </div>
                <div class="chart-three">
                    <div id="flotChart3" class="flot-chart ht-30"></div>
                  </div><!-- chart-three -->
              </div>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
              <div class="card card-body">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Unique Purchases</h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">3,137</h3>
                  <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.7% <i class="icon ion-md-arrow-down"></i></span></p>
                </div>
                <div class="chart-three">
                    <div id="flotChart4" class="flot-chart ht-30"></div>
                  </div><!-- chart-three -->
              </div>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
              <div class="card card-body">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Avg. Order Value</h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$306.20</h3>
                  <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.3% <i class="icon ion-md-arrow-down"></i></span></p>
                </div>
                <div class="chart-three">
                    <div id="flotChart5" class="flot-chart ht-30"></div>
                  </div><!-- chart-three -->
              </div>
            </div><!-- col -->
            <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
              <div class="card card-body">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Order Quantity</h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">1,650</h3>
                  <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">2.1% <i class="icon ion-md-arrow-up"></i></span></p>
                </div>
                <div class="chart-three">
                    <div id="flotChart6" class="flot-chart ht-30"></div>
                  </div><!-- chart-three -->
              </div>
            </div><!-- col -->
            <div class="col-lg-8 col-xl-7 mg-t-10">
              <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                  <h6 class="mg-b-0">Recurring Revenue Growth</h6>
                  <ul class="list-inline d-flex mg-t-20 mg-sm-t-10 mg-md-t-0 mg-b-0">
                    <li class="list-inline-item d-flex align-items-center">
                      <span class="d-block wd-10 ht-10 bg-df-1 rounded mg-r-5"></span>
                      <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Growth Actual</span>
                    </li>
                    <li class="list-inline-item d-flex align-items-center mg-l-5">
                      <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                      <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Actual</span>
                    </li>
                    <li class="list-inline-item d-flex align-items-center mg-l-5">
                      <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                      <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Plan</span>
                    </li>
                  </ul>
                </div><!-- card-header -->
                <div class="card-body pos-relative pd-0">
                  <div class="pos-absolute t-20 l-20 wd-xl-100p z-index-10">
                    <div class="row">
                      <div class="col-sm-5">
                        <h3 class="tx-normal tx-rubik tx-spacing--2 mg-b-5">$620,076</h3>
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-10">MRR Growth</h6>
                        <p class="mg-b-0 tx-12 tx-color-03">Measure How Fast You’re Growing Monthly Recurring Revenue. <a href="">Learn More</a></p>
                      </div><!-- col -->
                      <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                        <h3 class="tx-normal tx-rubik tx-spacing--2 mg-b-5">$1,200</h3>
                        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-10">Avg. MRR/Customer</h6>
                        <p class="mg-b-0 tx-12 tx-color-03">The revenue generated per account on a monthly or yearly basis. <a href="">Learn More</a></p>
                      </div><!-- col -->
                    </div><!-- row -->
                  </div>

                  <div class="chart-one">
                    <div id="flotChart" class="flot-chart"></div>
                  </div><!-- chart-one -->
                </div><!-- card-body -->
              </div><!-- card -->
            </div>

            <div class="col-lg-12 col-xl-8 mg-t-10">
              <div class="card mg-b-10">
                <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                  <div>
                    <h6 class="mg-b-5">Your Most Recent Earnings</h6>
                    <p class="tx-13 tx-color-03 mg-b-0">Your sales and referral earnings over the last 30 days</p>
                  </div>
                  <div class="d-flex mg-t-20 mg-sm-t-0">
                    <div class="btn-group flex-fill">
                      <button class="btn btn-white btn-xs active">Range</button>
                      <button class="btn btn-white btn-xs">Period</button>
                    </div>
                  </div>
                </div><!-- card-header -->
                <div class="card-body pd-y-30">
                  <div class="d-sm-flex">
                    <div class="media">
                      <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                        <i data-feather="bar-chart-2"></i>
                      </div>
                      <div class="media-body">
                        <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Gross Earnings</h6>
                        <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$1,958,104</h4>
                      </div>
                    </div>
                    <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                      <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                        <i data-feather="bar-chart-2"></i>
                      </div>
                      <div class="media-body">
                        <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Tax Withheld</h6>
                        <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$234,769<small>.50</small></h4>
                      </div>
                    </div>
                    <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                      <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                        <i data-feather="bar-chart-2"></i>
                      </div>
                      <div class="media-body">
                        <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Net Earnings</h6>
                        <h4 class="tx-20 tx-sm-18 tx-md-20 tx-normal tx-rubik mg-b-0">$1,608,469<small>.50</small></h4>
                      </div>
                    </div>
                  </div>
                </div><!-- card-body -->
                <div class="table-responsive">
                  <table class="table table-dashboard mg-b-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th class="text-right">Sales Count</th>
                        <th class="text-right">Gross Earnings</th>
                        <th class="text-right">Tax Withheld</th>
                        <th class="text-right">Net Earnings</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="tx-color-03 tx-normal">03/05/2018</td>
                        <td class="tx-medium text-right">1,050</td>
                        <td class="text-right tx-teal">+ $32,580.00</td>
                        <td class="text-right tx-pink">- $3,023.10</td>
                        <td class="tx-medium text-right">$28,670.90 <span class="mg-l-5 tx-10 tx-normal tx-success"><i class="icon ion-md-arrow-up"></i> 4.5%</span></td>
                      </tr>
                      <tr>
                        <td class="tx-color-03 tx-normal">03/04/2018</td>
                        <td class="tx-medium text-right">980</td>
                        <td class="text-right tx-teal">+ $30,065.10</td>
                        <td class="text-right tx-pink">- $2,780.00</td>
                        <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                      </tr>
                      <tr>
                        <td class="tx-color-03 tx-normal">03/04/2018</td>
                        <td class="tx-medium text-right">980</td>
                        <td class="text-right tx-teal">+ $30,065.10</td>
                        <td class="text-right tx-pink">- $2,780.00</td>
                        <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                      </tr>
                      <tr>
                        <td class="tx-color-03 tx-normal">03/04/2018</td>
                        <td class="tx-medium text-right">980</td>
                        <td class="text-right tx-teal">+ $30,065.10</td>
                        <td class="text-right tx-pink">- $2,780.00</td>
                        <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                      </tr>
                      <tr>
                        <td class="tx-color-03 tx-normal">03/04/2018</td>
                        <td class="tx-medium text-right">980</td>
                        <td class="text-right tx-teal">+ $30,065.10</td>
                        <td class="text-right tx-pink">- $2,780.00</td>
                        <td class="tx-medium text-right">$26,930.40  <span class="mg-l-5 tx-10 tx-normal tx-danger"><i class="icon ion-md-arrow-down"></i> 0.8%</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->


            </div>
          </div><!-- row -->
        </div><!-- container -->
      </div>
    </div>