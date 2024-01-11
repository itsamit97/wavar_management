<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop-Tbl</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Data table link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <!-- End Data table link  -->

</head>



<body>
    <div style="width: auto;  background-color: #8f7699; height:55px;  margin-bottom: 30px;">
        <!-- Button Shop  Modal-->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shopModal"
            style="margin-top: 8px; float: right;">
            Shop Modal
        </button>
    </div>

    <div class="container mt-3">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011-04-25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011-07-25</td>
                    <td>$170,750</td>
                </tr>
                <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009-01-12</td>
                    <td>$86,000</td>
                </tr>
                <tr>
                    <td>Cedric Kelly</td>
                    <td>Senior Javascript Developer</td>
                    <td>Edinburgh</td>
                    <td>22</td>
                    <td>2012-03-29</td>
                    <td>$433,060</td>
                </tr>
                <tr>
                    <td>Airi Satou</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>33</td>
                    <td>2008-11-28</td>
                    <td>$162,700</td>
                </tr>
                <tr>
                    <td>Brielle Williamson</td>
                    <td>Integration Specialist</td>
                    <td>New York</td>
                    <td>61</td>
                    <td>2012-12-02</td>
                    <td>$372,000</td>
                </tr>
                <tr>
                    <td>Herrod Chandler</td>
                    <td>Sales Assistant</td>
                    <td>San Francisco</td>
                    <td>59</td>
                    <td>2012-08-06</td>
                    <td>$137,500</td>
                </tr>
                <tr>
                    <td>Rhona Davidson</td>
                    <td>Integration Specialist</td>
                    <td>Tokyo</td>
                    <td>55</td>
                    <td>2010-10-14</td>
                    <td>$327,900</td>
                </tr>
                <tr>
                    <td>Colleen Hurst</td>
                    <td>Javascript Developer</td>
                    <td>San Francisco</td>
                    <td>39</td>
                    <td>2009-09-15</td>
                    <td>$205,500</td>
                </tr>
                <tr>
                    <td>Sonya Frost</td>
                    <td>Software Engineer</td>
                    <td>Edinburgh</td>
                    <td>23</td>
                    <td>2008-12-13</td>
                    <td>$103,600</td>
                </tr>

            </tbody>

        </table>
    </div>

    <!--User Shop  Modal -->
    <div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Shop Modal </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('shop.store')}}" method="post">
                        <!-- @csrf -->
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <lable>Shop Name</lable>
                                <input type="text" name="shop_name" class="form-control" placeholder="Enter Shop Name"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <lable>Sort-Order</lable>
                                <input type="text" name="sort_order" class="form-control" placeholder="Enter Sort-Order">
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-6">
                                <lable>Main Branch</lable>
                                <input type="text" name="branch_identifier" class="form-control" placeholder="Enter Main Branch Identifir"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <lable>Contact Period</lable>
                                <input type="text" name="contact_period" class="form-control" placeholder="Enter Contact Period">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <lable>Phone No.</lable>
                                <input type="text" name="phone_no" class="form-control" placeholder="Enter Phone No"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <lable>User Name</lable>
                                <input type="text" name="user_name" class="form-control" placeholder="EnterUser Name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <lable>Password</lable>
                                <input type="text" name="password" class="form-control" placeholder="Enter Password"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <lable>User Name</lable>
                                <input type="text" name="user_name" class="form-control" placeholder="EnterUser Name">
                            </div>
                        </div>



                        <div>
                            <lable>Hobbies</lable><br>
                            <lable>cricket</lable>
                            <input type="checkbox" name="hobbies[]" value="cricket">
                            <lable>Swimming</lable>
                            <input type="checkbox" name="hobbies[]" value="swimming">
                            <lable>Dancing</lable>
                            <input type="checkbox" name="hobbies[]" value="dancing">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End User Shop  Modal -->

    <script>
    new DataTable('#example');
    </script>

</body>

</html>