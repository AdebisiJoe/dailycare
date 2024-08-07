<?php $__env->startSection('stylesheet'); ?>
        <!-- DataTables CSS -->
    <link href="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo e(asset('plugins/datatables-responsive/css/dataTables.responsive.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="content">
   <div class="row">
    <div class = "col-md-11">
        <div class = "nav-tabs-custom">
            <ul class = "nav nav-tabs">
                <li class = "active"><a href = "#home" data-toggle = "tab">Register first User</a></li>
                <li><a href = "#messages" data-toggle = "tab">Register New Admin</a></li>
                <li><a href = "#settings" data-toggle = "tab">MLM Comission Settings</a></li>
                <li><a href = "#setactivecountries" data-toggle = "tab">Set Active Country </a></li>
               
               
            </ul>
            <div class = "tab-content">
                <div class = "active tab-pane" id = "home">
                    <!--Post -->

                    <?php if($firstusercount>0): ?>
                       <H1>THE First User is registered already</H1>
                    <?php else: ?>

                         <form role = "form" class = "form-horizontal" id = "defaultForm" method = "post" action = "<?php echo e(url('/registerfirstuser')); ?>">
                       <!--/.personal box -->

                        <div class = "box-body">
                           

                            <input type = "hidden" class = "form-control" id = "parentid" name = "role" placeholder = "" value="firstuser">

                            

                           

                      <!--  <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "Registrationpin">Registration Pin</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "Registrationpin" name = "registrationpin" placeholder = "Enter Registration Pin">
                                    
                                </div>
                                 <div class="col-md-2">
                                 <a style="color:green" href="<?php echo e(url('/buy-pin')); ?>" target="_blank">Buy pin</a>
                                   
                                </div>
                               
                            </div>  -->  
                           

                        </div>
                        <div class = "box-header with-border">
                            <h3 class = "box-title">Personal Information</h3>
                        </div><!--/.personal box -->

                        <div class = "box-body">


                             
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "registrationpin">Registration Pin</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id="registrationpin" name="registrationpin" placeholder = "Enter Registration Pin">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "firstname">First Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "firstname" name = "firstname" placeholder = "Enter firstname">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "lastame">Middle Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "middlename" name = "middlename" placeholder = "Enter Middle Name">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "lastame">Last Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "lastname" name = "lastname" placeholder = "Enter Lastname">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "lastame">Date of Birth</label>
                                </div>
                                <div class= "col-md-4">
                                    <div class = "input-group date" data-provide = "datepicker">
                                        <input type = "text" class = "form-control" name="dob">
                                        <div class = "input-group-addon">
                                            <span class = "glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class = "col-md-2">
                                    <label for = "lastame">Gender</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control sex" name="sex">
                                        <option class="0" disabled="true" selected="true">--Gender--</option>
                                        <option class="1" value="male" >Male</option>
                                        <option class="2" value="female">Female</option>
                                    </select>
                                </div>       
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "email">Email address</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Enter email">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "phonenumber">Phone Number</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "phonenumber" class = "form-control" id = "phonenumber" name = "phonenumber" placeholder = "Enter Phone Number">
                                </div>
                            </div>
                        </div>
                        <div class = "box-header with-border">
                            <h3 class = "box-title">Contact Information</h3>
                        </div><!--/.personal box -->
                        <div class = "box-body">

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "country">Country</label>
                                </div>
                                <div class = "col-md-4">

                                    <select class="form-control" id = "country"  name="country">                
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Ind Ocean Terr">British Ind. Ocean Terr.</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Rep.">Central African Rep.</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos Keeling">Cocos Keeling</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="country.PS">country PS</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Cote d Ivoire">Cote d Ivoire</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="East Timor">East Timor</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El salvador">El salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands">Falkland Islands</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Sthern Terr">French Southern Terr.</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea Bissau">Guinea Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Is McDonald Is">Heard Is McDonald Is</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakstan">Kazakstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgystan">Kyrgystan</option>
                                        <option value="Lao">Lao</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia: FYR">Macedonia FYR</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option selected="" value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="North Korea">North Korea</option>
                                        <option value="Northern Mariana Is.">Northern Mariana Is</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia">South Georgia</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="St Helena">St Helena</option>
                                        <option value="St Kitts+Nevis">St Kitts Nevis</option>
                                        <option value="St Lucia">St Lucia</option>
                                        <option value="St Pierre Miquelon">St Pierre Miquelon</option>
                                        <option value="St Vincent+Grenadines">St Vincent Grenadines</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard Jan Mayen Is">Svalbard Jan Mayen Is</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Is">Turks and Caicos Is</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="US Minor Outlying Is">US Minor Outlying Is</option>
                                        <option value="USA">USA</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City State">Vatican City State</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Is British">Virgin Is British</option>
                                        <option value="Virgin Is US">Virgin Is US</option>
                                        <option value="Wallis and Futuna Is">Wallis and Futuna Is</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Yugoslavia">Yugoslavia</option>
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "state">State</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "state" name = "state" placeholder = "Enter state">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "address">City</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "address" name = "city" placeholder = "Enter City">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "address">Address</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "address" name = "address" placeholder = "Enter address">
                                </div>
                            </div>

                        </div>


                        <div class = "box-header with-border">
                            <h3 class = "box-title">Security Information</h3>
                        </div><!--/.personal box -->
                        <div class = "box-body">
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "username">Username</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "username" name = "username" placeholder = "Enter username">
                                </div>
                                <span id="user-result"></span>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "password">Password</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "password" name = "password" placeholder = "Enter password">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "password2">Confirm Password</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "password2" name = "password2" placeholder = "Confirm password">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "transactionpass">Transaction Password</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "transactionpass" name = "transactionpass" placeholder = "Enter Transaction password">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "transactionpass">Confirm Transaction Password</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "transactionpass2" name = "transactionpass2" placeholder = "Conf Transaction password">
                                </div>
                            </div>



                        </div>

                        <div class = "box-header with-border">
                            <h3 class = "box-title">Bank Information</h3>
                        </div><!--/.personal box -->
                        <div class = "box-body">
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "accountname">Account Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "accountname" name = "accountname" placeholder = "Enter Account Name">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "accountnumber">Account Number</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "accountnumber" name = "accountnumber" placeholder = "Enter Account Number" >
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "bankbranch">Bank Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "bankbranch" name = "bankname" placeholder = "Enter Bank Name">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "accountnumber">Branch Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "accountnumber" name = "bankbranch" placeholder = "Enter Branch">
                                </div>
                            </div>


                        </div><!--/.box-body -->

                       <!-- <div class = "box-header with-border">
                            <h3 class = "box-title">Next of Kin Details</h3>
                        </div>

                        <div class = "box-body">
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "kinname">Name of Next of Kin</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "kinname" name = "nameofkin" placeholder = "Enter Name of Next of kin">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "phonenumber">Phone Number</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "phonenumber" name = "phonenumberofkin" placeholder = "Enter Phone Number of Kin" >
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "kinrelationship">Relationship</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "kinrelationship" name = "kinrelationship" placeholder = "Enter Relationship with next of kin">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "nextofkinaddress">Next of kin Address</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "nextofkinaddress" name = "nextofkinaddress" placeholder = "Enter address of next of kin">
                                </div>
                            </div>




                        </div>--><!--/.box-body -->

                        <div class = "box-footer">
                            <button type = "submit" class = "btn btn-success">Submit</button>
                        </div>
                    </form>
                    <?php endif; ?>    






                </div><!--/.tab-pane -->
                <div class = "tab-pane" id = "messages">
                    <!--The timeline -->
                    <form role = "form" class = "form-horizontal" method = "post" action = "<?php echo e(url('/registeradmin')); ?>">
                        <div class = "box-body">
       
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "firstname">First Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "email" name = "firstname" placeholder = "Enter Firstname">
                                </div>
                            </div>    
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "email">Email address</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Enter email">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "username">User Name</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "text" class = "form-control" id = "email" name = "username" placeholder = "Enter Username">
                                </div>
                            </div> 
                             <div class="form-group">
                                <div class = "col-md-2">
                                    <label for = "lastame">Role</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control role" name="role">
                                        <option class="0" disabled="true" selected="true">--Role--</option>
                                        <option class="1" value="admin" >Super Admin</option>
                                        <option class="2" value="shopadmin">Customer Care</option>
                                    </select>
                                </div>       
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "password">Password</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "password" name = "password" placeholder = "Enter password">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "password2">Confirm Password</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "password2" name = "password2" placeholder = "Enter password">
                                </div>
                            </div>

                            <div class = "form-group">
                                <div class = "col-md-2">
                                <label for = "transactionpass">Transaction Password<label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "password" name = "transactionpass" placeholder = "Enter Trans password">
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "col-md-2">
                                    <label for = "password2">Confirm trans Password</label>
                                </div>
                                <div class = "col-md-4">
                                    <input type = "password" class = "form-control" id = "password2" name = "" placeholder = "Enter Confirm trans Password">
                                </div>
                            </div>
                        </div><!--/.box-body -->
                        <div class = "box-footer">
                        <button type = "submit" class = "btn btn-success">Submit</button>
                        </div>
                    </form>

                </div><!--/.tab-pane -->

                <div class = "tab-pane" id = "settings">
                    <form >
                        <div class = "form-group">
                            <table class = "table table-bordered">
                                <thead>
                                <th>Level Name</th>
                                <th>Stage</th>
                                <th>level</th>
                                <th>Expected Downlines</th>
                                <th>Bonus</th>


                                <th style = "text-align;background:#eee"><a class = "addmore"><i class = "fa fa-plus"></i></a></th>
                                </thead>
                                <tbody>
                                    <?php foreach($mlmlevel as $mlmlevels): ?>
                                    <tr>
                                        <td> <input type = "text" name = "levelname[]" id = "levelname_1" class = "form-control" value = "<?php echo $mlmlevels->name; ?>" ></td>
                                        <td><input type = "text" name = "level[]" data-type = "productName" id = "level_1" value = "<?php echo $mlmlevels->stage_number; ?>" class = "form-control"></td>
                                        <td><input type = "text" name = "stage[]" data-type = "productName" id = "stage_1" value = "<?php echo $mlmlevels->stage_number; ?>" class = "form-control"></td>
                                        <td><input type = "text" name = "dowlines[]" id = "dowlines_1" class = "form-control" value = "<?php echo $mlmlevels->noofdownlines; ?>" onkeypress = "return IsNumeric(event);" ></td>
                                        <td><input type = "text" name = "bonus[]" id = "bonus_1" class = "form-control" value = "<?php echo $mlmlevels->bonus; ?>" onkeypress = "return IsNumeric(event);" ></td>
                                        <td><a class = "btn btn-danger remove"><i class = "fa fa-remove"></i></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>


                        <div class = "box-footer">
                            <button type = "submit" class = "btn btn-success">Submit</button>
                        </div>
                    </form>
                </div><!--/.tab-pane -->
                <div class = "tab-pane" id = "setactivecountries">
           

                 <form>
                        <div class = "form-group">
                            <table class = "table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <th>Country Name</th>
                                
                                <th>Currency</th>
                                <th>Food Dollar equivalent</th>
                                <th>Html Code</th>
                                <th>Active</th>
                                 
                                </thead>
                                <tbody>
                                    <?php foreach($countrycurrencies as $countrycurrency): ?>
                                    <tr>
                                        <td> <input type = "text" name = "countryname[]" id = "countryname_1" class = "form-control" value = "<?php echo $countrycurrency->name; ?>" ></td>
                                        <td><input type = "text" name = "currency[]" data-type = "productName" id = "currency_1" value = "<?php echo $countrycurrency->currencyname; ?>" class = "form-control"></td>

                                        <td><input type = "text" name = "foodequ[]" data-type = "productName" id = "foodequ_1" value = "<?php echo $countrycurrency->foodequ; ?>" class = "form-control"></td>
                                        <td><input type = "text" name = "htmlcode[]" data-type = "productName" id = "htmlcode_1" value = "<?php echo $countrycurrency->htmlcode; ?>" class ="form-control"></td>
                                        <td><input type="checkbox" value="1" checked="checked" ></td>


                                        
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>


                        <div class = "box-footer">
                            <button type = "submit" class = "btn btn-success">Submit</button>
                        </div>
                    </form>
           
                </div><!--/.tab-pane -->
            </div><!--/.tab-content -->
        </div><!--/.nav-tabs-custom -->
    </div><!--/.col -->
   </div>

</section>
<meta name="_token" content="<?php echo csrf_token(); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


<script type = "text/javascript">
    //Initialize Select2 Elements
    $(".select2").select2();

    var i = $('table tr').length;

    $(".addmore").on('click', function () {
        html = '<tr>';
        html += ' <td> <input type="text" name="levelname[]" id="levelname_' + i + '" class="form-control"   ></td>';
        html += '<td><input type="text"  name="level[]" data-type="productName" id="level_' + i + '" class="form-control"></td>';
        html += '<td><input type="text" name="dowlines[]" id="dowlines_' + i + '" class="form-control" onkeypress="return IsNumeric(event);" ></td>';
        html += '<td><input type = "text" name = "stage[]" data-type = "productName" id = "stage_' + i + '"  class = "form-control"></td>';
        html += '<td><input type="text" name="bonus[]" id="bonus_' + i + '" class="form-control" onkeypress="return IsNumeric(event);" ></td>';
        html += '<td><a class="btn btn-danger remove"><i class="fa fa-remove"></i></a></td>';
        html += '</tr>';
        $('table').append(html);
        i++;
    });

    $(document).on('click', '.remove', function () {
        var r = confirm("are you sure you want to remove this bonus ?")
        if (r == true) {
            $(this).parent().parent().remove();
        } else {

        }



    });

    $(document).ready(function() {
    $("#username").keyup(function (e) {
    
        //removes spaces from username
        $(this).val($(this).val().replace(/\s/g, ''));
        
        var username = $(this).val();
        if(username.length <= 4){
            $("#user-result").html('');
            return;
    }
       
        if(username.length >= 4){
            $("#user-result").html("<img src='<?php echo e(asset('images/availableimg/ajax-loader.gif')); ?>'/>");
           
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    $.ajax({
        type:"POST",
        url:"<?php echo URL::route('availableusername'); ?>",
        dataType:'json',
        data:{'username':username},
        success:function(data){
            //$("#user-result").html(data); 
            console.log(data);
            //var json =JSON.parse(data); 
            var json=data;
            if ( json.availability === "available" ) {
     $("#user-result").html("Available <img src='<?php echo e(asset('images/availableimg/available.png')); ?>'/>"); 
            }else{
    $("#user-result").html("Not-Available <img src='<?php echo e(asset('images/availableimg/not-available.png')); ?>'/>");   
            }
        }

    });













            

        }
    }); 
});


</script> 
<!-- datepicker -->
<script src="<?php echo e(asset('plugins/datepicker/bootstrap-datepicker.js')); ?>"></script> 
<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    $(document).ready(function () {
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>