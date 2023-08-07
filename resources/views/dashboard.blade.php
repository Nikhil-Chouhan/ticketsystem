@extends('layouts.app')

@section('content')

{{-- <div class="uk-grid-match uk-grid-collapse uk-grid" uk-height-viewport="expand: true" uk-grid="" style="min-height: 430px;">
      
      <div class="uk-width-expand@m">
          <div class="uk-container uk-container-expand uk-margin-large-top uk-margin-bottom">
              <div class="uk-grid uk-grid-row-medium uk-grid-column-small uk-grid-match uk-margin-medium-bottom" uk-grid="">     
              
              <div class="uk-width-1-2 uk-width-1-3@s uk-width-1-3@m uk-width-1-6@l uk-width-1-6@xl report-box uk-first-column">
                      <div class="counter-container tm-item uk-card uk-card-default uk-card-body uk-padding-remove uk-card-hover" data-number="200" data-percentage="100" data-radius="120" data-duration="2500" data-uniqid="uk-counter-d" data-animated="true">
                          <h2 class="el-number uk-margin-remove uk-padding-small uk-position-top-left">{{ $ticketdata->count() }}</h2>
                          <div class="uk-text-small uk-text-primary uk-padding-small uk-position-bottom-right">Live Tickets
                          </div>
                          <div class="uk-animation-toggle uk-cover-container" tabindex="0">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 246.033 99.303" class="tm-image uk-animation-stroke uk-svg" style="--uk-animation-stroke:330;">
                                  <g transform="translate(-525.578 -4365.5)">
                                      <g transform="translate(526.078 4366)">
                                          <path d="M0,98.066Q21.3,41.571,34.624,41.571c13.325,0,20.82,21.852,34.977,21.852,19.269,0,24.984-13.324,35.81-13.324,6.433,0,23.318-11.725,34.144-11.725,13.014,0,22.6,25.049,34.977,25.049,13.371,0,15.823-38.373,33.311-38.373S244.249,0,245.034,0" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"></path>
                                      </g>
                                      <g transform="translate(526.078 4389.984)">
                                          <path d="M0,74.318Q16.3,54.362,34.624,54.362c18.321,0,15.849-28.732,34.574-28.732s20.157,23.513,35.4,23.513C124.565,49.144,121.684,0,140.388,0c15.076,0,22.485,23.629,33.907,23.629s19.776,9.415,35.214,9.415c10.826,0,27.276-29.967,35.525-30.5" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2.5"></path>
                                      </g>
                                  </g>
                              </svg>
                          </div>
                      </div>
                  </div>

              <div class="uk-width-1-2 uk-width-1-3@s uk-width-1-3@m uk-width-1-6@l uk-width-1-6@xl report-box uk-first-column">
                      <div class="counter-container tm-item uk-card uk-card-default uk-card-body uk-padding-remove uk-card-hover" data-number="200" data-percentage="100" data-radius="120" data-duration="2500" data-uniqid="uk-counter-d" data-animated="true">
                          <h2 class="el-number uk-margin-remove uk-padding-small uk-position-top-left">{{ $userdata->count() }}</h2>
                          <div class="uk-text-small uk-text-primary uk-padding-small uk-position-bottom-right">Users
                          </div>
                          <div class="uk-animation-toggle uk-cover-container" tabindex="0">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 246.033 99.303" class="tm-image uk-animation-stroke uk-svg" style="--uk-animation-stroke:330;">
                                  <g transform="translate(-525.578 -4365.5)">
                                      <g transform="translate(526.078 4366)">
                                          <path d="M0,98.066Q21.3,41.571,34.624,41.571c13.325,0,20.82,21.852,34.977,21.852,19.269,0,24.984-13.324,35.81-13.324,6.433,0,23.318-11.725,34.144-11.725,13.014,0,22.6,25.049,34.977,25.049,13.371,0,15.823-38.373,33.311-38.373S244.249,0,245.034,0" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"></path>
                                      </g>
                                      <g transform="translate(526.078 4389.984)">
                                          <path d="M0,74.318Q16.3,54.362,34.624,54.362c18.321,0,15.849-28.732,34.574-28.732s20.157,23.513,35.4,23.513C124.565,49.144,121.684,0,140.388,0c15.076,0,22.485,23.629,33.907,23.629s19.776,9.415,35.214,9.415c10.826,0,27.276-29.967,35.525-30.5" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2.5"></path>
                                      </g>
                                  </g>
                              </svg>
                          </div>
                      </div>
                  </div>
                 
                  <div class="uk-width-1-2 uk-width-1-3@s uk-width-1-3@m uk-width-1-6@l uk-width-1-6@xl report-box uk-first-column">
                      <div class="counter-container tm-item uk-card uk-card-default uk-card-body uk-padding-remove uk-card-hover" data-number="200" data-percentage="100" data-radius="120" data-duration="2500" data-uniqid="uk-counter-d" data-animated="true">
                          <h2 class="el-number uk-margin-remove uk-padding-small uk-position-top-left">{{ $companydata->count() }}</h2>
                          <div class="uk-text-small uk-text-primary uk-padding-small uk-position-bottom-right">Companies
                          </div>
                          <div class="uk-animation-toggle uk-cover-container" tabindex="0">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 246.033 99.303" class="tm-image uk-animation-stroke uk-svg" style="--uk-animation-stroke:330;">
                                  <g transform="translate(-525.578 -4365.5)">
                                      <g transform="translate(526.078 4366)">
                                          <path d="M0,98.066Q21.3,41.571,34.624,41.571c13.325,0,20.82,21.852,34.977,21.852,19.269,0,24.984-13.324,35.81-13.324,6.433,0,23.318-11.725,34.144-11.725,13.014,0,22.6,25.049,34.977,25.049,13.371,0,15.823-38.373,33.311-38.373S244.249,0,245.034,0" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"></path>
                                      </g>
                                      <g transform="translate(526.078 4389.984)">
                                          <path d="M0,74.318Q16.3,54.362,34.624,54.362c18.321,0,15.849-28.732,34.574-28.732s20.157,23.513,35.4,23.513C124.565,49.144,121.684,0,140.388,0c15.076,0,22.485,23.629,33.907,23.629s19.776,9.415,35.214,9.415c10.826,0,27.276-29.967,35.525-30.5" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2.5"></path>
                                      </g>
                                  </g>
                              </svg>
                          </div>
                      </div>
                  </div>

                  <div class="uk-width-1-2 uk-width-1-3@s uk-width-1-3@m uk-width-1-6@l uk-width-1-6@xl report-box uk-first-column">
                      <div class="counter-container tm-item uk-card uk-card-default uk-card-body uk-padding-remove uk-card-hover" data-number="200" data-percentage="100" data-radius="120" data-duration="2500" data-uniqid="uk-counter-d" data-animated="true">
                          <h2 class="el-number uk-margin-remove uk-padding-small uk-position-top-left">{{ $branchdata->count() }}</h2>
                          <div class="uk-text-small uk-text-primary uk-padding-small uk-position-bottom-right">Branches
                          </div>
                          <div class="uk-animation-toggle uk-cover-container" tabindex="0">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 246.033 99.303" class="tm-image uk-animation-stroke uk-svg" style="--uk-animation-stroke:330;">
                                  <g transform="translate(-525.578 -4365.5)">
                                      <g transform="translate(526.078 4366)">
                                          <path d="M0,98.066Q21.3,41.571,34.624,41.571c13.325,0,20.82,21.852,34.977,21.852,19.269,0,24.984-13.324,35.81-13.324,6.433,0,23.318-11.725,34.144-11.725,13.014,0,22.6,25.049,34.977,25.049,13.371,0,15.823-38.373,33.311-38.373S244.249,0,245.034,0" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"></path>
                                      </g>
                                      <g transform="translate(526.078 4389.984)">
                                          <path d="M0,74.318Q16.3,54.362,34.624,54.362c18.321,0,15.849-28.732,34.574-28.732s20.157,23.513,35.4,23.513C124.565,49.144,121.684,0,140.388,0c15.076,0,22.485,23.629,33.907,23.629s19.776,9.415,35.214,9.415c10.826,0,27.276-29.967,35.525-30.5" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2.5"></path>
                                      </g>
                                  </g>
                              </svg>
                          </div>
                      </div>
                  </div>

                  <div class="uk-width-1-2 uk-width-1-3@s uk-width-1-3@m uk-width-1-6@l uk-width-1-6@xl report-box uk-first-column">
                      <div class="counter-container tm-item uk-card uk-card-default uk-card-body uk-padding-remove uk-card-hover" data-number="200" data-percentage="100" data-radius="120" data-duration="2500" data-uniqid="uk-counter-d" data-animated="true">
                          <h2 class="el-number uk-margin-remove uk-padding-small uk-position-top-left">{{ $productdata->count() }}</h2>
                          <div class="uk-text-small uk-text-primary uk-padding-small uk-position-bottom-right">Products
                          </div>
                          <div class="uk-animation-toggle uk-cover-container" tabindex="0">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 246.033 99.303" class="tm-image uk-animation-stroke uk-svg" style="--uk-animation-stroke:330;">
                                  <g transform="translate(-525.578 -4365.5)">
                                      <g transform="translate(526.078 4366)">
                                          <path d="M0,98.066Q21.3,41.571,34.624,41.571c13.325,0,20.82,21.852,34.977,21.852,19.269,0,24.984-13.324,35.81-13.324,6.433,0,23.318-11.725,34.144-11.725,13.014,0,22.6,25.049,34.977,25.049,13.371,0,15.823-38.373,33.311-38.373S244.249,0,245.034,0" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"></path>
                                      </g>
                                      <g transform="translate(526.078 4389.984)">
                                          <path d="M0,74.318Q16.3,54.362,34.624,54.362c18.321,0,15.849-28.732,34.574-28.732s20.157,23.513,35.4,23.513C124.565,49.144,121.684,0,140.388,0c15.076,0,22.485,23.629,33.907,23.629s19.776,9.415,35.214,9.415c10.826,0,27.276-29.967,35.525-30.5" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2.5"></path>
                                      </g>
                                  </g>
                              </svg>
                          </div>
                      </div>
                  </div>

                  <div class="uk-width-1-2 uk-width-1-3@s uk-width-1-3@m uk-width-1-6@l uk-width-1-6@xl report-box uk-first-column">
                      <div class="counter-container tm-item uk-card uk-card-default uk-card-body uk-padding-remove uk-card-hover" data-number="200" data-percentage="100" data-radius="120" data-duration="2500" data-uniqid="uk-counter-d" data-animated="true">
                          <h2 class="el-number uk-margin-remove uk-padding-small uk-position-top-left">{{ $servicedata->count() }}</h2>
                          <div class="uk-text-small uk-text-primary uk-padding-small uk-position-bottom-right">Services
                          </div>
                          <div class="uk-animation-toggle uk-cover-container" tabindex="0">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 246.033 99.303" class="tm-image uk-animation-stroke uk-svg" style="--uk-animation-stroke:330;">
                                  <g transform="translate(-525.578 -4365.5)">
                                      <g transform="translate(526.078 4366)">
                                          <path d="M0,98.066Q21.3,41.571,34.624,41.571c13.325,0,20.82,21.852,34.977,21.852,19.269,0,24.984-13.324,35.81-13.324,6.433,0,23.318-11.725,34.144-11.725,13.014,0,22.6,25.049,34.977,25.049,13.371,0,15.823-38.373,33.311-38.373S244.249,0,245.034,0" fill="none" stroke="#000" stroke-linecap="round" stroke-width="1"></path>
                                      </g>
                                      <g transform="translate(526.078 4389.984)">
                                          <path d="M0,74.318Q16.3,54.362,34.624,54.362c18.321,0,15.849-28.732,34.574-28.732s20.157,23.513,35.4,23.513C124.565,49.144,121.684,0,140.388,0c15.076,0,22.485,23.629,33.907,23.629s19.776,9.415,35.214,9.415c10.826,0,27.276-29.967,35.525-30.5" fill="none" stroke="#000" stroke-linecap="round" stroke-width="2.5"></path>
                                      </g>
                                  </g>
                              </svg>
                          </div>
                      </div>
                  </div>


              </div>
              <div class="uk-grid uk-grid-medium uk-grid-match" uk-grid="">

              <div class="uk-width-1-2@s uk-width-1-4@l uk-width-1-4@xl">
                      <div class="uk-card uk-card-default uk-card-small uk-card-hover uk-border-rounded">
                          <div class="uk-card-header">
                              <span class="uk-text-muted">Active Tickets</span>
                          </div>
                          <div class="uk-card-body">
                              <table class="uk-table uk-table-divider uk-table-justify uk-table-small uk-table-middle">
                                  <tbody>
                                      <tr>
                                          <td><span class="uk-text-muted uk-margin-small-right uk-icon" uk-icon="file-text"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect fill="none" stroke="#000" width="13" height="17" x="3.5" y="1.5"></rect><line fill="none" stroke="#000" x1="6" x2="12" y1="12.5" y2="12.5"></line><line fill="none" stroke="#000" x1="6" x2="14" y1="8.5" y2="8.5"></line><line fill="none" stroke="#000" x1="6" x2="14" y1="6.5" y2="6.5"></line><line fill="none" stroke="#000" x1="6" x2="14" y1="10.5" y2="10.5"></line></svg></span><small>Live Tickets</small></td>
                                          <td class="uk-text-center">
                                              <span class="uk-badge">{{ $ticketdata->count() }}</span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td><span class="uk-text-muted uk-margin-small-right uk-icon" uk-icon="album"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="2" width="10" height="1"></rect><rect x="3" y="4" width="14" height="1"></rect><rect fill="none" stroke="#000" x="1.5" y="6.5" width="17" height="11"></rect></svg></span><small>In QnA</small></td>
                                          <td class="uk-text-center">
                                          <span class="uk-badge">{{ $ticketdata->where('status', 'QnA')->count() }}</span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td><span class="uk-text-muted uk-margin-small-right uk-icon" uk-icon="commenting"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><polygon fill="none" stroke="#000" points="1.5,1.5 18.5,1.5 18.5,13.5 10.5,13.5 6.5,17.5 6.5,13.5 1.5,13.5"></polygon><circle cx="10" cy="8" r="1"></circle><circle cx="6" cy="8" r="1"></circle><circle cx="14" cy="8" r="1"></circle></svg></span><small>Approved QnA</small></td>
                                          <td class="uk-text-center">
                                          <span class="uk-badge">{{ $ticketdata->where('status', 'QnA Pass')->count() }}</span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td><span class="uk-text-muted uk-margin-small-right uk-icon" uk-icon="mail"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" points="1.4,6.5 10,11 18.6,6.5"></polyline><path d="M 1,4 1,16 19,16 19,4 1,4 Z M 18,15 2,15 2,5 18,5 18,15 Z"></path></svg></span><small>Failed QnA</small></td>
                                          <td class="uk-text-center">
                                          <span class="uk-badge">{{ $ticketdata->where('status', 'QnA Fail')->count() }}</span>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td><span class="uk-text-muted uk-margin-small-right uk-icon" uk-icon="mail"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" points="1.4,6.5 10,11 18.6,6.5"></polyline><path d="M 1,4 1,16 19,16 19,4 1,4 Z M 18,15 2,15 2,5 18,5 18,15 Z"></path></svg></span><small>Closed Tickets</small></td>
                                          <td class="uk-text-center">
                                          <span class="uk-badge">{{ $ticketdata->where('status', 'Close')->count() }}</span>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>

                  <div class="uk-width-1-2@s uk-width-1-3@l uk-grid-margin">
                    <div class="uk-card uk-card-default uk-card-small uk-card-hover uk-border-rounded">
                        <div class="uk-card-header">
                            <span class="uk-text-muted">Ticket Bucket</span>
                        </div>
                        <div class="tm-chart uk-card-body">
                            <canvas id="chart2" width="441" height="337" style="display: block; box-sizing: border-box; height: 269.6px; width: 352.8px;"></canvas>
                        </div>
                    </div>
                </div>

              <div class="uk-width-1-2@s uk-width-1-3@l uk-grid-margin uk-first-column">
                      <div class="uk-card uk-card-default uk-card-small uk-card-hover uk-border-rounded">
                          <div class="uk-card-header">
                              <span class="uk-text-muted">High Priority Tickets</span>
                          </div>
                          <div class="uk-card-body">
                              <table class="uk-table uk-table-divider uk-table-justify uk-table-small uk-table-middle">
                                  <tbody>
                                   
                                  @foreach($ticketdata->where('priority', 'High') as $key => $ticket)
                                 
                                  @if($key < 6)  

                                   <tr class="tm-item">
                                          <td><span class="uk-text-muted uk-margin-small-right uk-icon" uk-icon="nut"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><polygon fill="none" stroke="#000" points="2.5,5.7 10,1.3 17.5,5.7 17.5,14.3 10,18.7 2.5,14.3"></polygon><circle fill="none" stroke="#000" cx="10" cy="10" r="3.5"></circle></svg></span><small>Ticket ID: {{ $ticket->ticket_id }}</small></td>
                                          <td class="uk-text-right"><small>Raised At: {{ $ticket->ticket_raised }}</small></td>
                                      </tr>
                                   @endif
                                      
                                  @endforeach
                                     
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                
                <!-- <div class="uk-width-1-2@l uk-first-column">
                      <div class="uk-card uk-card-default uk-card-small uk-card-hover uk-border-rounded">
                          <div class="uk-card-header">
                              <span class="uk-text-muted">visitor statistics</span>
                          </div>
                          <div class="uk-card-body">
                              <canvas id="chart1" width="705" height="187" style="display: block; box-sizing: border-box; height: 149.6px; width: 564px;"></canvas>
                          </div>
                      </div>
                  </div>    

                <div class="uk-width-1-2@s uk-width-1-4@l uk-width-1-4@xl">
                      <div class="uk-card uk-card-default uk-card-small uk-card-hover uk-border-rounded">
                          <div class="uk-card-header uk-text-center">
                              <span class="uk-text-muted">people online</span>
                          </div>
                          <div class="uk-card-body">
                              <div class="counter-container uk-text-center" data-number="20" data-percentage="100" data-radius="120" data-duration="5000" data-uniqid="uk-counter-user" data-animated="true">
                                  <div class="uk-inline">
                                      <svg class="el-circle" width="150" height="150" viewBox="0 0 264 264" id="uk-counter-user">
                                          <circle class="counter-meter" cx="132" cy="132" r="120" stroke-width="10" fill="none"></circle>
                                          <circle class="counter-value" cx="132" cy="132" r="120" stroke="rgba(30, 135, 240, 0.8)" stroke-width="10" fill="none" style="stroke-dashoffset: 0; stroke-dasharray: 753.982;"></circle>
                                      </svg>
                                      <div class="uk-overlay uk-position-cover">
                                          <div class="uk-position-center">
                                              <span class="el-number uk-h1 uk-text-primary">20</span>
                                              <span class="el-text uk-h5"><br>online</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div> -->
                              
                <!-- <div class="uk-width-1-3@l uk-grid-margin">
                    <div class="uk-card uk-card-default uk-card-small uk-card-hover uk-border-rounded">
                        <div class="uk-card-header">
                            <span class="uk-text-muted">visitor statistics</span>
                        </div>
                        <div class="tm-chart uk-card-body">
                            <canvas id="chart3" width="441" height="337" style="display: block; box-sizing: border-box; height: 269.6px; width: 352.8px;"></canvas>
                        </div>
                    </div>
                </div> -->

                
               
              </div>
   
          </div>
      </div>
  </div>



  <script id="rendered-js">
  var char1El = document.getElementById('chart1');
  new Chart(char1El, {
    type: 'bar',
    data: {
      labels: ["today", "yesterday", "week", "last week", "month", "last month", "year", "total"],
      datasets: [{
        label: "",
        backgroundColor: ["#42a5f5", "#2196f3", "#1e88e5", "#ff6384", "#1976d2", "#ff6384", "#1565c0", "#0d47a1"],
        data: [200, 170, 1400, 1200, 150000, 120000, 300000, 400000] }] },
  
  
    options: {
      maintainAspectRatio: false,
      responsiveAnimationDuration: 500,
      plugins: {
        legend: {
          display: false },
  
        animation: {
          duration: 2000 },
  
        title: {
          display: true,
          text: '2022-08-08' } } } });
  
  
          var support_bucket = {!! json_encode($ticketdata->where('isLive',0)->where('escalate',0)->count()) !!};
         var pm_bucket = {!!  json_encode($ticketdata->where('escalate',1)->where('isLive',0)->count()) !!};
          var management_bucket = {!! json_encode($ticketdata->where('escalate',2)->where('isLive',0)->count()) !!};
  
  console.log(support_bucket);

  var char2El = document.getElementById('chart2');
  new Chart(char2El, {
    type: 'doughnut',
    data: {
      labels: ["Support Bucket", "PM Bucket", "Management"],
      datasets: [{
        label: "",
        backgroundColor: ["#ff6384", "#0d47a1", "#1976d2"],
        data: [support_bucket, pm_bucket, management_bucket] }] },
  
  
    options: {
      maintainAspectRatio: false,
      responsiveAnimationDuration: 500,
      animation: {
        duration: 2000 },
  
      title: {
        display: false,
        text: '' } } });
  
  
  
  var char3El = document.getElementById('chart3');
  new Chart(char3El, {
    type: 'radar',
    data: {
      labels: ["visitor", "visitor", "visitor"],
      datasets: [{
        label: "last month",
        fill: true,
        backgroundColor: "rgba(255,99,132,0.2)",
        borderColor: "rgba(255,99,132,1)",
        pointBorderColor: "#fff",
        pointBackgroundColor: "rgba(255,99,132,1)",
        data: [120000, 120000, 120000] },
      {
        label: "month",
        fill: true,
        backgroundColor: "rgba(51,153,255,0.6)",
        borderColor: "rgba(51,153,255,0.2)",
        pointBorderColor: "#fff",
        pointBackgroundColor: "rgba(179,181,198,1)",
        data: [150000, 150000, 150000] }] },
  
  
    options: {
      maintainAspectRatio: false,
      responsiveAnimationDuration: 500,
      animation: {
        duration: 2000 },
  
      title: {
        display: false,
        text: '' } } });
  
  
  
  
  // counter
  function countUp(t, e, a, n, r) {
    let i,o = a - e,
    s = Math.abs(Math.floor(n / o)),
    l = new Date().getTime() + n;
  
    function d() {
      let e = new Date().getTime(),
      s = Math.max((l - e) / n, 0),
      d = Math.round(a - s * o);
      t.innerHTML = void 0 === r ? d : d.toLocaleString(r, {
        useGrouping: !0 }),
      d == a && clearInterval(i);
    }
    i = setInterval(d, s), d();
  }
  
  function startAnimation() {
    let t = document.querySelectorAll(".counter-container");
    for (let e = 0; e < t.length; e++) {
      let a = t[e];
      if (!a.getAttribute("data-animated") && UIkit.util.isInView(a)) {
        let t = 2 * Math.PI * a.dataset.radius,
        e = a.querySelector(".counter-value"),
        n = a.querySelector(".el-number"),
        r = a.querySelector(".el-circle");
        r && r.setAttribute("id", a.dataset.uniqid), e && (e.style.strokeDashoffset = t * (1 - a.dataset.percentage / 100), e.style.strokeDasharray = t), n && countUp(n, 0, a.dataset.number, parseInt(a.dataset.duration), a.dataset.separatorLocale), a.setAttribute("data-animated", !0);
      }
    }
  }
  UIkit.util.ready(function () {
    startAnimation(), window.addEventListener("load", startAnimation, !1), window.addEventListener("scroll", startAnimation, !1), window.addEventListener("resize", startAnimation, !1);
  });
</script> --}}


@endsection