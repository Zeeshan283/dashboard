@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content') 
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid " id="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Training Detail</h5>
                        </div>
                        <div class="card-body">
                        <form method="post" action="{{ route('cfeatures.store') }}">
                                @csrf
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Course Features</h5>
                                    <hr class="my-0"/>
                                    <div class="card-body">
                                        <div class="row">
        <div class="col-sm-6">
            <div class="form-group" ml-10>
                <label for="instructor" class="form-label">Instructor</label>
                <input type="text" class="form-control" id="instructor" placeholder="Instructor Name" name="instructor"  required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="rating" class="form-label">Rating</label>
                <input type="text" class="form-control" id="rating" placeholder="Total rating" name="rating" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="lectures" class="form-label">Lectures</label>
                <input type="text" class="form-control" id="lectures" placeholder="Total lectures" name="lectures" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" class="form-control" id="duration" placeholder="duration" name="duration" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
            <label for="skilllevel" class="form-label">Skill Level</label>
                      <select class="form-select" id="skilllevel" name="skilllevel">
                        <option value=""> Please Select </option>
                        <option>Basic Level</option>
                        <option>Intermediate</option>
                        <option>Expert Level</option>
                      </select>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
            <label for="language" class="form-label">Languages</label>
                      <select class="form-select" id="language" name="language">
                        <option value=""> --- Please Select --- </option>
                        <option>Aaland Islands</option>
                        <option>Afghanistan</option>
                        <option>Albania</option>
                        <option>Algeria</option>
                        <option>American Samoa</option>
                        <option>Andorra</option>
                        <option>Angola</option>
                        <option>Anguilla</option>
                        <option>Antarctica</option>
                        <option>Antigua and Barbuda</option>
                        <option>Argentina</option>
                        <option>Armenia</option>
                        <option>Aruba</option>
                        <option>Ascension Island (British)</option>
                        <option>Australia</option>
                        <option>Austria</option>
                        <option>Azerbaijan</option>
                        <option>Bahamas</option>
                        <option>Bahrain</option>
                        <option>Bangladesh</option>
                        <option>Barbados</option>
                        <option>Belarus</option>
                        <option>Belgium</option>
                        <option>Belize</option>
                        <option>Benin</option>
                        <option>Bermuda</option>
                        <option>Bhutan</option>
                        <option>Bolivia</option>
                        <option>Bonaire, Sint Eustatius and Saba</option>
                        <option>Bosnia and Herzegovina</option>
                        <option>Botswana</option>
                        <option>Bouvet Island</option>
                        <option>Brazil</option>
                        <option>British Indian Ocean Territory</option>
                        <option>Brunei Darussalam</option>
                        <option>Bulgaria</option>
                        <option>Burkina Faso</option>
                        <option>Burundi</option>
                        <option>Cambodia</option>
                        <option>Cameroon</option>
                        <option>Canada</option>
                        <option>Canary Islands</option>
                        <option>Cape Verde</option>
                        <option>Cayman Islands</option>
                        <option>Central African Republic</option>
                        <option>Chad</option>
                        <option>Chile</option>
                        <option>China</option>
                        <option>Christmas Island</option>
                        <option>Cocos (Keeling) Islands</option>
                        <option>Colombia</option>
                        <option>Comoros</option>
                        <option>Congo</option>
                        <option>Cook Islands</option>
                        <option>Costa Rica</option>
                        <option>Cote D'Ivoire</option>
                        <option>Croatia</option>
                        <option>Cuba</option>
                        <option>Curacao</option>
                        <option>Cyprus</option>
                        <option>Czech Republic</option>
                        <option>Democratic Republic of Congo</option>
                        <option>Denmark</option>
                        <option>Djibouti</option>
                        <option>Dominica</option>
                        <option>Dominican Republic</option>
                        <option>East Timor</option>
                        <option>Ecuador</option>
                        <option>Egypt</option>
                        <option>El Salvador</option>
                        <option>Equatorial Guinea</option>
                        <option>Eritrea</option>
                        <option>Estonia</option>
                        <option>Ethiopia</option>
                        <option>Falkland Islands (Malvinas)</option>
                        <option>Faroe Islands</option>
                        <option>Fiji</option>
                        <option>Finland</option>
                        <option>France, Metropolitan</option>
                        <option>French Guiana</option>
                        <option>French Polynesia</option>
                        <option>French Southern Territories</option>
                        <option>FYROM</option>
                        <option>Gabon</option>
                        <option>Gambia</option>
                        <option>Georgia</option>
                        <option>Germany</option>
                        <option>Ghana</option>
                        <option>Gibraltar</option>
                        <option>Greece</option>
                        <option>Greenland</option>
                        <option>Grenada</option>
                        <option>Guadeloupe</option>
                        <option>Guam</option>
                        <option>Guatemala</option>
                        <option>Guernsey</option>
                        <option>Guinea</option>
                        <option>Guinea-Bissau</option>
                        <option>Guyana</option>
                        <option>Haiti</option>
                        <option>Heard and Mc Donald Islands</option>
                        <option>Honduras</option>
                        <option>Hong Kong</option>
                        <option>Hungary</option>
                        <option>Iceland</option>
                        <option>India</option>
                        <option>Indonesia</option>
                        <option>Iran (Islamic Republic of)</option>
                        <option>Iraq</option>
                        <option>Ireland</option>
                        <option>Isle of Man</option>
                        <option>Israel</option>
                        <option>Italy</option>
                        <option>Jamaica</option>
                        <option>Japan</option>
                        <option>Jersey</option>
                        <option>Jordan</option>
                        <option>Kazakhstan</option>
                        <option>Kenya</option>
                        <option>Kiribati</option>
                        <option>Korea, Republic of</option>
                        <option>Kosovo, Republic of</option>
                        <option>Kuwait</option>
                        <option>Kyrgyzstan</option>
                        <option>Lao People's Democratic Republic</option>
                        <option>Latvia</option>
                        <option>Lebanon</option>
                        <option>Lesotho</option>
                        <option>Liberia</option>
                        <option>Libyan Arab Jamahiriya</option>
                        <option>Liechtenstein</option>
                        <option>Lithuania</option>
                        <option>Luxembourg</option>
                        <option>Macau</option>
                        <option>Madagascar</option>
                        <option>Malawi</option>
                        <option>Malaysia</option>
                        <option>Maldives</option>
                        <option>Mali</option>
                        <option>Malta</option>
                        <option>Marshall Islands</option>
                        <option>Martinique</option>
                        <option>Mauritania</option>
                        <option>Mauritius</option>
                        <option>Mayotte</option>
                        <option>Mexico</option>
                        <option>Micronesia, Federated States of</option>
                        <option>Moldova, Republic of</option>
                        <option>Monaco</option>
                        <option>Mongolia</option>
                        <option>Montenegro</option>
                        <option>Montserrat</option>
                        <option>Morocco</option>
                        <option>Mozambique</option>
                        <option>Myanmar</option>
                        <option>Namibia</option>
                        <option>Nauru</option>
                        <option>Nepal</option>
                        <option>Netherlands</option>
                        <option>Netherlands Antilles</option>
                        <option>New Caledonia</option>
                        <option>New Zealand</option>
                        <option>Nicaragua</option>
                        <option>Niger</option>
                        <option>Nigeria</option>
                        <option>Niue</option>
                        <option>Norfolk Island</option>
                        <option>North Korea</option>
                        <option>Northern Mariana Islands</option>
                        <option>Norway</option>
                        <option>Oman</option>
                        <option selected="selected">Pakistan</option>
                        <option>Palau</option>
                        <option>Palestinian Territory, Occupied</option>
                        <option>Panama</option>
                        <option>Papua New Guinea</option>
                        <option>Paraguay</option>
                        <option>Peru</option>
                        <option>Philippines</option>
                        <option>Pitcairn</option>
                        <option>Poland</option>
                        <option>Portugal</option>
                        <option>Puerto Rico</option>
                        <option>Qatar</option>
                        <option>Reunion</option>
                        <option>Romania</option>
                        <option>Russian Federation</option>
                        <option>Rwanda</option>
                        <option>Saint Kitts and Nevis</option>
                        <option>Saint Lucia</option>
                        <option>Saint Vincent and the Grenadines</option>
                        <option>Samoa</option>
                        <option>San Marino</option>
                        <option>Sao Tome and Principe</option>
                        <option>Saudi Arabia</option>
                        <option>Senegal</option>
                        <option>Serbia</option>
                        <option>Seychelles</option>
                        <option>Sierra Leone</option>
                        <option>Singapore</option>
                        <option>Slovak Republic</option>
                        <option>Slovenia</option>
                        <option>Solomon Islands</option>
                        <option>Somalia</option>
                        <option>South Africa</option>
                        <option>South Georgia &amp; South Sandwich Islands</option>
                        <option>South Sudan</option>
                        <option>Spain</option>
                        <option>Sri Lanka</option>
                        <option>St. Barthelemy</option>
                        <option>St. Helena</option>
                        <option>St. Martin (French part)</option>
                        <option>St. Pierre and Miquelon</option>
                        <option>Sudan</option>
                        <option>Suriname</option>
                        <option>Svalbard and Jan Mayen Islands</option>
                        <option>Swaziland</option>
                        <option>Sweden</option>
                        <option>Switzerland</option>
                        <option>Syrian Arab Republic</option>
                        <option>Taiwan</option>
                        <option>Tajikistan</option>
                        <option>Tanzania, United Republic of</option>
                        <option>Thailand</option>
                        <option>Togo</option>
                        <option>Tokelau</option>
                        <option>Tonga</option>
                        <option>Trinidad and Tobago</option>
                        <option>Tristan da Cunha</option>
                        <option>Tunisia</option>
                        <option>Turkey</option>
                        <option>Turkmenistan</option>
                        <option>Turks and Caicos Islands</option>
                        <option>Tuvalu</option>
                        <option>Uganda</option>
                        <option>Ukraine</option>
                        <option>United Arab Emirates</option>
                        <option>United Kingdom</option>
                        <option>United States</option>
                        <option>United States Minor Outlying Islands</option>
                        <option>Uruguay</option>
                        <option>Uzbekistan</option>
                        <option>Vanuatu</option>
                        <option>Vatican City State (Holy See)</option>
                        <option>Venezuela</option>
                        <option>Viet Nam</option>
                        <option>Virgin Islands (British)</option>
                        <option>Virgin Islands (U.S.)</option>
                        <option>Wallis and Futuna Islands</option>
                        <option>Western Sahara</option>
                        <option>Yemen</option>
                        <option>Zambia</option>
                        <option>Zimbabwe</option>
                      </select>
            </div>
        </div>
<div class="col-sm-6">
            <div class="form-group">
                <label for="coursefee" class="form-label">Course Fee</label>
                <input type="number" class="form-control" id="coursefee" placeholder="Course fee (Price)" name="coursefee" required>
            </div>
        </div>
                                            </div> 
                                        </div>
                                        <div class="mt-2 " style="text-align: right">
                                            <button type="submit" class="btn btn-outline-secondary  me-2">Add Blogs</button>
                                        </div>
                                    </div>
                                    <!-- /Account -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    @endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection


