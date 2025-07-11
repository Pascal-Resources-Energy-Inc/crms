<div class="modal fade" id="homeModal" tabindex="-1" aria-labelledby="homeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="homeModalLabel">Last purchase was more than 3 days ago.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 col-xl-12 d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body">

                    <div class="table-responsive" data-simplebar>
                      <table class="table table-borderless align-middle text-nowrap">
                        <thead>
                         <tr>
                                <th scope="col">Client</th>
                                <th scope="col">Number</th>
                                <th scope="col">Address</th>
                                <th scope="col">Last Purchase</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($customers_less as $cus)
                            <tr>
                              <td>{{$cus->name}}</td>
                              <td>{{$cus->number}}</td>
                              <td>{{$cus->address}}</td>
                              <td>{{date('M d, Y',strtotime($cus->latestTransaction->date))}}</td>
                          
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>