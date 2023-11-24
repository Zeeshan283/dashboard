@extends('layouts.master')
@section('before-css')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection
@endsection
@section('main-content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="breadcrumb">
                <h2 class="col-lg-12">Payment Method</h2>
            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="card col-lg-12">
    <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 fw-400 mb-4">Credit or Debit Cards <span class="text-muted text-4">(for payments)</span></h3>
             <hr class="mb-4 mx-n4"> 
            <div class="row g-3">
              <div class="col-12 col-md-6 col-lg-4">
                <div class="account-card account-card-primary text-white rounded p-3 hover-card">
                  <p class="text-4">XXXX-XXXX-XXXX-4151</p>
                  <p class="d-flex align-items-center"> <span class="account-card-expire text-uppercase d-inline-block opacity-7 me-2">Valid<br>
                    thru<br>
                    </span> <span class="text-4 opacity-9">07/24</span> <span class="badge bg-warning text-dark text-0 fw-800 rounded-pill px-1 ms-auto">Primary</span> </p>
                  <p class="d-flex align-items-center m-0"> <span class="text-uppercase fw-500">Saliha Kazmi</span> <img class="ms-auto" src="data:image/png;base64,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" alt="visa" title=""> </p>
                  <div class="account-card-overlay rounded"> <a href="#" data-bs-toggle="modal" data-bs-target="#edit-card-details" onclick="showEditCardModal()"><span class="me-1"><i class="fas fa-edit"></i></span>Edit</a> <a href="#" class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a> </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4">
                <div class="account-card text-white rounded p-3 hover-card">
                  <p class="text-4">XXXX-XXXX-XXXX-6296</p>
                  <p class="d-flex align-items-center"> <span class="account-card-expire text-uppercase d-inline-block opacity-7 me-2">Valid<br>
                    thru<br>
                    </span> <span class="text-4 opacity-9">07/23</span> </p>
                  <p class="d-flex align-items-center m-0"> <span class="text-uppercase fw-500">Saliha Kazmi</span> <img class="ms-auto" src="https://pngimg.com/uploads/mastercard/mastercard_PNG23.png" alt="mastercard" title=""> </p>
                  <div class="account-card-overlay rounded">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit-card-details" onclick="showEditCardModal()"><span class="me-1"><i class="fas fa-edit"></i></span>Edit</a> 
                  <a href="#" class="text-light btn-link mx-2"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a> </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-4"> 
              <a href="#" data-bs-target="add-new-card-details" data-bs-toggle="modal" class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0" aria-labelledby="add-new-card-details-label" aria-hidden="true">
  <p class="w-100 text-center lh-base m-0">
    <span class="text-3"><i class="fas fa-plus-circle"></i></span>
    <span class="d-block text-body text-3" onclick="showAddCardModal()">Add New Card</span>
  </p>
</a>

            </div>
            </div>
          </div>

         <!-- .................................................... Edit Card detail Models........................................................... -->


         <div id="edit-card-details" class="modal fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fw-400">Update Card</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"  onclick="hideEditCardModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                  <form id="updateCard" method="post">
                    <div class="mb-3">
                      <label for="edircardNumber" class="form-label">Card Number</label>
<span><img class="ms-auto1" src="data:image/png;base64,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" alt="visa" title=""></span>
                      <div class="input-group">
                        <input type="text" class="form-control" data-bv-field="edircardNumber" id="edircardNumber" value="XXXXXXXXXXXX4151" placeholder="Card Number">
                      </div>
                    </div>
                    <div class="row g-3 mb-3">
                      <div class="col-lg-6">
                          <label for="editexpiryDate" class="form-label">Expiry Date</label>
                          <input id="editexpiryDate" type="text" class="form-control" data-bv-field="editexpiryDate" required="" value="07/24" placeholder="MM/YY">
                      </div>
                      <div class="col-lg-6">
                          <label for="editcvvNumber" class="form-label">CVV <span class="text-info ms-1" data-bs-toggle="tooltip" title="" data-bs-original-title="For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number." aria-label="For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number."><i class="fas fa-question-circle"></i></span></label>
                          <input id="editcvvNumber" type="password" class="form-control" data-bv-field="editcvvNumber" required="" value="321" placeholder="CVV (3 digits)">
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="editcardHolderName" class="form-label">Card Holder Name</label>
                      <input type="text" class="form-control" data-bv-field="editcardHolderName" id="editcardHolderName" required="" value="Saliha Kazmi" placeholder="Card Holder Name">
                    </div>
                    <div class="d-grid mt-4"><button class="btn btn-primary" type="submit">Update Card</button></div>
                  </form>
                </div>
              </div>
            </div>
          </div>

            <!-- .................................................... Add New Card detail Models........................................................... -->

            <div id="add-new-card-details" class="modal fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fw-400">Add a Card</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"  onclick="hideAddCardModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                  <form id="addCard" method="post">
					<div class="btn-group d-flex mb-3" role="group">
                      <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked="">
					  <label class="btn btn-outline-secondary btn-sm shadow-none w-100" for="option1">Debit</label>
					  
					  <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                      <label class="btn btn-outline-secondary btn-sm shadow-none w-100" for="option2">Credit</label>
                    </div>
                    <div class="row g-3">
					<div class="col-12">
                      <label for="cardType" class="form-label">Card Type</label>
                      <select id="cardType" class="form-select" required="">
                        <option value="">Card Type</option>
                        <option>Visa</option>
                        <option>MasterCard</option>
                        <option>American Express</option>
                        <option>Discover</option>
                      </select>
                    </div>
                    <div class="col-12">
                      <label for="cardNumber" class="form-label">Card Number</label>
                      <input type="text" class="form-control" data-bv-field="cardnumber" id="cardNumber" required="" value="" placeholder="Card Number">
                    </div>
                    <div class="col-lg-6">
                       <label for="expiryDate" class="form-label">Expiry Date</label>
                       <input id="expiryDate" type="text" class="form-control" data-bv-field="expiryDate" required="" value="" placeholder="MM/YY">
                    </div>
                    <div class="col-lg-6">
                       <label for="cvvNumber" class="form-label">CVV <span class="text-info ms-1" data-bs-toggle="tooltip" title="" data-bs-original-title="For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number." aria-label="For Visa/Mastercard, the three-digit CVV number is printed on the signature panel on the back of the card immediately after the card's account number. For American Express, the four-digit CVV number is printed on the front of the card above the card account number."><i class="fas fa-question-circle"></i></span></label>
                       <input id="cvvNumber" type="password" class="form-control" data-bv-field="cvvnumber" required="" value="" placeholder="CVV (3 digits)">
                    </div>
                    <div class="col-12">
                      <label for="cardHolderName" class="form-label">Card Holder Name</label>
                      <input type="text" class="form-control" data-bv-field="cardholdername" id="cardHolderName" required="" value="" placeholder="Card Holder Name">
                    </div>
                    <div class="col-12 d-grid mt-4">
					  <button class="btn btn-primary" type="submit">Add Card</button>
					</div>
					</div>
                  </form>
                </div>
              </div>
            </div>
          </div>

               <!-- .................................................... Bank Accounts ........................................................... -->
       
               <div class="bg-white shadow-sm rounded p-4 mb-4">
            <h3 class="text-5 fw-400 mb-4">Bank Accounts <span class="text-muted text-4">(for withdrawal)</span></h3>
            <hr class="mb-4 mx-n4">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <div class="account-card account-card-primary text-white rounded hover-card">
                  <div class="row g-0">
                    <div class="col-3 d-flex justify-content-center p-3"><br>
                      <div class="my-auto text-center"> <span class="text-13" style="font-size: 70px;"><i class="fas fa-university"></i></span>
                        <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">Primary</p>
                      </div>
                    </div>
                    <div class="col-9 border-start">
					<div class="py-4 my-2 ps-4">
                        <p class="text-4 fw-500 mb-1">HDFC Bank</p>
                        <p class="text-4 opacity-9 mb-1">XXXXXXXXXXXX-9025</p>
                        <p class="m-0">Approved <span class="text-3"><i class="fas fa-check-circle"></i></span></p>
                      </div>
                    </div>
                  </div>
                  <div class="account-card-overlay rounded"> 
                    <a href="#" data-bs-target="#bank-account-details" data-bs-toggle="modal" class="text-light btn-link mx-2" onclick="showBankAccountModal()">
                        <span class="me-1"><i class="fas fa-share"></i></span>More Details</a>
                         <a href="#" class="text-light btn-link mx-2">
                            <span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a> </div>
                </div>
              </div>
              <div class="col-12 col-md-6"> <a href="#" data-bs-target="#add-new-bank-account" data-bs-toggle="modal" class="account-card-new d-flex align-items-center rounded h-100 p-3 mb-4 mb-lg-0" onclick="showAddBankAccountModal()">
                <p class="w-100 text-center lh-base m-0"> <span class="text-3"><i class="fas fa-plus-circle"></i></span> <span class="d-block text-body text-3">Add New Bank Account</span> </p>
                </a> </div>
            </div>
          </div>

               <!-- .................................................... Bank Account Detail Model ........................................................... -->
    
               <div id="bank-account-details" class="modal fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row g-0">
                    <div class="col-sm-4  justify-content-center" style="background-color: green;">
                      <div class="my-auto text-center">
                        <div class="text-17 text-white mb-3" style="font-size: 60px;"><i class="fas fa-university"></i></div>
                        <h3 class="text-6 text-white my-3">HDFC Bank</h3>
                        <div class="text-4 text-white my-4">XXX-9027 | US</div>
                        <p class="badge bg-light text-dark text-0 fw-500 rounded-pill px-2 mb-0">Primary</p>
                      </div>
                    </div>
                    <div class="col-sm-7">
                    <button type="button" class="btn-close text-2 float-end"  onclick="hideBankAccountModal()" aria-label="Close"></button>
                      <h5 class="text-5 fw-400 m-3">Bank Account Details
                      </h5>
                      <hr>
                      <div class="px-3 mb-3">
                        <ul class="list-unstyled">
                          <li class="fw-500">Account Type:</li>
                          <li class="text-muted">Personal</li>
                        </ul>
                        <ul class="list-unstyled">
                          <li class="fw-500">Account Name:</li>
                          <li class="text-muted">Saliha Kazmi</li>
                        </ul>
                        <ul class="list-unstyled">
                          <li class="fw-500">Account Number:</li>
                          <li class="text-muted">XXXXXXXXXXXX-9025</li>
                        </ul>
                        <ul class="list-unstyled">
                          <li class="fw-500">Bank Country:</li>
                          <li class="text-muted">Pakistan</li>
                        </ul>
                        <ul class="list-unstyled">
                          <li class="fw-500">Status:</li>
                          <li class="text-muted">Approved <span class="text-success text-3"><i class="fas fa-check-circle"></i></span></li>
                        </ul>
                        <div class="d-grid"><a href="#" class="btn btn-sm btn-outline-danger shadow-none" onclick="hideBankAccountModal()"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete Account</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

               <!-- .................................................... Add New Bank Account Detail Models ........................................................... -->
      
               <div id="add-new-bank-account" class="modal fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    
                  <h5 class="modal-title fw-400">Add bank account</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"  onclick="hideAddBankAccountModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                  <form id="addbankaccount" method="post">
                    <div class="mb-3">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="personal" name="bankAccountType" checked="" required="" type="radio">
                        <label class="form-check-label" for="personal">Personal</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="business" name="bankAccountType" required="" type="radio">
                        <label class="form-check-label" for="business">Business</label>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="inputCountry" class="form-label">Bank Country</label>
                      <!-- <select class="form-select" id="inputCountry" disabled="" name="country_id"> -->
                      <select class="form-select" id="inputCountry" name="country_id">
                        <option value=""> --- Please Select --- </option>
                        <option value="244">Aaland Islands</option>
                        <option value="1">Afghanistan</option>
                        <option value="2">Albania</option>
                        <option value="3">Algeria</option>
                        <option value="4">American Samoa</option>
                        <option value="5">Andorra</option>
                        <option value="6">Angola</option>
                        <option value="7">Anguilla</option>
                        <option value="8">Antarctica</option>
                        <option value="9">Antigua and Barbuda</option>
                        <option value="10">Argentina</option>
                        <option value="11">Armenia</option>
                        <option value="12">Aruba</option>
                        <option value="252">Ascension Island (British)</option>
                        <option value="13">Australia</option>
                        <option value="14">Austria</option>
                        <option value="15">Azerbaijan</option>
                        <option value="16">Bahamas</option>
                        <option value="17">Bahrain</option>
                        <option value="18">Bangladesh</option>
                        <option value="19">Barbados</option>
                        <option value="20">Belarus</option>
                        <option value="21">Belgium</option>
                        <option value="22">Belize</option>
                        <option value="23">Benin</option>
                        <option value="24">Bermuda</option>
                        <option value="25">Bhutan</option>
                        <option value="26">Bolivia</option>
                        <option value="245">Bonaire, Sint Eustatius and Saba</option>
                        <option value="27">Bosnia and Herzegovina</option>
                        <option value="28">Botswana</option>
                        <option value="29">Bouvet Island</option>
                        <option value="30">Brazil</option>
                        <option value="31">British Indian Ocean Territory</option>
                        <option value="32">Brunei Darussalam</option>
                        <option value="33">Bulgaria</option>
                        <option value="34">Burkina Faso</option>
                        <option value="35">Burundi</option>
                        <option value="36">Cambodia</option>
                        <option value="37">Cameroon</option>
                        <option value="38">Canada</option>
                        <option value="251">Canary Islands</option>
                        <option value="39">Cape Verde</option>
                        <option value="40">Cayman Islands</option>
                        <option value="41">Central African Republic</option>
                        <option value="42">Chad</option>
                        <option value="43">Chile</option>
                        <option value="44">China</option>
                        <option value="45">Christmas Island</option>
                        <option value="46">Cocos (Keeling) Islands</option>
                        <option value="47">Colombia</option>
                        <option value="48">Comoros</option>
                        <option value="49">Congo</option>
                        <option value="50">Cook Islands</option>
                        <option value="51">Costa Rica</option>
                        <option value="52">Cote D'Ivoire</option>
                        <option value="53">Croatia</option>
                        <option value="54">Cuba</option>
                        <option value="246">Curacao</option>
                        <option value="55">Cyprus</option>
                        <option value="56">Czech Republic</option>
                        <option value="237">Democratic Republic of Congo</option>
                        <option value="57">Denmark</option>
                        <option value="58">Djibouti</option>
                        <option value="59">Dominica</option>
                        <option value="60">Dominican Republic</option>
                        <option value="61">East Timor</option>
                        <option value="62">Ecuador</option>
                        <option value="63">Egypt</option>
                        <option value="64">El Salvador</option>
                        <option value="65">Equatorial Guinea</option>
                        <option value="66">Eritrea</option>
                        <option value="67">Estonia</option>
                        <option value="68">Ethiopia</option>
                        <option value="69">Falkland Islands (Malvinas)</option>
                        <option value="70">Faroe Islands</option>
                        <option value="71">Fiji</option>
                        <option value="72">Finland</option>
                        <option value="74">France, Metropolitan</option>
                        <option value="75">French Guiana</option>
                        <option value="76">French Polynesia</option>
                        <option value="77">French Southern Territories</option>
                        <option value="126">FYROM</option>
                        <option value="78">Gabon</option>
                        <option value="79">Gambia</option>
                        <option value="80">Georgia</option>
                        <option value="81">Germany</option>
                        <option value="82">Ghana</option>
                        <option value="83">Gibraltar</option>
                        <option value="84">Greece</option>
                        <option value="85">Greenland</option>
                        <option value="86">Grenada</option>
                        <option value="87">Guadeloupe</option>
                        <option value="88">Guam</option>
                        <option value="89">Guatemala</option>
                        <option value="256">Guernsey</option>
                        <option value="90">Guinea</option>
                        <option value="91">Guinea-Bissau</option>
                        <option value="92">Guyana</option>
                        <option value="93">Haiti</option>
                        <option value="94">Heard and Mc Donald Islands</option>
                        <option value="95">Honduras</option>
                        <option value="96">Hong Kong</option>
                        <option value="97">Hungary</option>
                        <option value="98">Iceland</option>
                        <option selected="selected" value="99">India</option>
                        <option value="100">Indonesia</option>
                        <option value="101">Iran (Islamic Republic of)</option>
                        <option value="102">Iraq</option>
                        <option value="103">Ireland</option>
                        <option value="254">Isle of Man</option>
                        <option value="104">Israel</option>
                        <option value="105">Italy</option>
                        <option value="106">Jamaica</option>
                        <option value="107">Japan</option>
                        <option value="257">Jersey</option>
                        <option value="108">Jordan</option>
                        <option value="109">Kazakhstan</option>
                        <option value="110">Kenya</option>
                        <option value="111">Kiribati</option>
                        <option value="113">Korea, Republic of</option>
                        <option value="253">Kosovo, Republic of</option>
                        <option value="114">Kuwait</option>
                        <option value="115">Kyrgyzstan</option>
                        <option value="116">Lao People's Democratic Republic</option>
                        <option value="117">Latvia</option>
                        <option value="118">Lebanon</option>
                        <option value="119">Lesotho</option>
                        <option value="120">Liberia</option>
                        <option value="121">Libyan Arab Jamahiriya</option>
                        <option value="122">Liechtenstein</option>
                        <option value="123">Lithuania</option>
                        <option value="124">Luxembourg</option>
                        <option value="125">Macau</option>
                        <option value="127">Madagascar</option>
                        <option value="128">Malawi</option>
                        <option value="129">Malaysia</option>
                        <option value="130">Maldives</option>
                        <option value="131">Mali</option>
                        <option value="132">Malta</option>
                        <option value="133">Marshall Islands</option>
                        <option value="134">Martinique</option>
                        <option value="135">Mauritania</option>
                        <option value="136">Mauritius</option>
                        <option value="137">Mayotte</option>
                        <option value="138">Mexico</option>
                        <option value="139">Micronesia, Federated States of</option>
                        <option value="140">Moldova, Republic of</option>
                        <option value="141">Monaco</option>
                        <option value="142">Mongolia</option>
                        <option value="242">Montenegro</option>
                        <option value="143">Montserrat</option>
                        <option value="144">Morocco</option>
                        <option value="145">Mozambique</option>
                        <option value="146">Myanmar</option>
                        <option value="147">Namibia</option>
                        <option value="148">Nauru</option>
                        <option value="149">Nepal</option>
                        <option value="150">Netherlands</option>
                        <option value="151">Netherlands Antilles</option>
                        <option value="152">New Caledonia</option>
                        <option value="153">New Zealand</option>
                        <option value="154">Nicaragua</option>
                        <option value="155">Niger</option>
                        <option value="156">Nigeria</option>
                        <option value="157">Niue</option>
                        <option value="158">Norfolk Island</option>
                        <option value="112">North Korea</option>
                        <option value="159">Northern Mariana Islands</option>
                        <option value="160">Norway</option>
                        <option value="161">Oman</option>
                        <option value="162">Pakistan</option>
                        <option value="163">Palau</option>
                        <option value="247">Palestinian Territory, Occupied</option>
                        <option value="164">Panama</option>
                        <option value="165">Papua New Guinea</option>
                        <option value="166">Paraguay</option>
                        <option value="167">Peru</option>
                        <option value="168">Philippines</option>
                        <option value="169">Pitcairn</option>
                        <option value="170">Poland</option>
                        <option value="171">Portugal</option>
                        <option value="172">Puerto Rico</option>
                        <option value="173">Qatar</option>
                        <option value="174">Reunion</option>
                        <option value="175">Romania</option>
                        <option value="176">Russian Federation</option>
                        <option value="177">Rwanda</option>
                        <option value="178">Saint Kitts and Nevis</option>
                        <option value="179">Saint Lucia</option>
                        <option value="180">Saint Vincent and the Grenadines</option>
                        <option value="181">Samoa</option>
                        <option value="182">San Marino</option>
                        <option value="183">Sao Tome and Principe</option>
                        <option value="184">Saudi Arabia</option>
                        <option value="185">Senegal</option>
                        <option value="243">Serbia</option>
                        <option value="186">Seychelles</option>
                        <option value="187">Sierra Leone</option>
                        <option value="188">Singapore</option>
                        <option value="189">Slovak Republic</option>
                        <option value="190">Slovenia</option>
                        <option value="191">Solomon Islands</option>
                        <option value="192">Somalia</option>
                        <option value="193">South Africa</option>
                        <option value="194">South Georgia &amp; South Sandwich Islands</option>
                        <option value="248">South Sudan</option>
                        <option value="195">Spain</option>
                        <option value="196">Sri Lanka</option>
                        <option value="249">St. Barthelemy</option>
                        <option value="197">St. Helena</option>
                        <option value="250">St. Martin (French part)</option>
                        <option value="198">St. Pierre and Miquelon</option>
                        <option value="199">Sudan</option>
                        <option value="200">Suriname</option>
                        <option value="201">Svalbard and Jan Mayen Islands</option>
                        <option value="202">Swaziland</option>
                        <option value="203">Sweden</option>
                        <option value="204">Switzerland</option>
                        <option value="205">Syrian Arab Republic</option>
                        <option value="206">Taiwan</option>
                        <option value="207">Tajikistan</option>
                        <option value="208">Tanzania, United Republic of</option>
                        <option value="209">Thailand</option>
                        <option value="210">Togo</option>
                        <option value="211">Tokelau</option>
                        <option value="212">Tonga</option>
                        <option value="213">Trinidad and Tobago</option>
                        <option value="255">Tristan da Cunha</option>
                        <option value="214">Tunisia</option>
                        <option value="215">Turkey</option>
                        <option value="216">Turkmenistan</option>
                        <option value="217">Turks and Caicos Islands</option>
                        <option value="218">Tuvalu</option>
                        <option value="219">Uganda</option>
                        <option value="220">Ukraine</option>
                        <option value="221">United Arab Emirates</option>
                        <option value="222">United Kingdom</option>
                        <option value="223">United States</option>
                        <option value="224">United States Minor Outlying Islands</option>
                        <option value="225">Uruguay</option>
                        <option value="226">Uzbekistan</option>
                        <option value="227">Vanuatu</option>
                        <option value="228">Vatican City State (Holy See)</option>
                        <option value="229">Venezuela</option>
                        <option value="230">Viet Nam</option>
                        <option value="231">Virgin Islands (British)</option>
                        <option value="232">Virgin Islands (U.S.)</option>
                        <option value="233">Wallis and Futuna Islands</option>
                        <option value="234">Western Sahara</option>
                        <option value="235">Yemen</option>
                        <option value="238">Zambia</option>
                        <option value="239">Zimbabwe</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="bankName" class="form-label">Bank Name</label>
                      <select class="form-select" id="bankName" name="bankName">
                        <option value=""> Please Select </option>
                        <option value="1">Bank Name 1</option>
                        <option value="2">Bank Name 2</option>
                        <option value="3">Bank Name 3</option>
                        <option value="4">Bank Name 4</option>
                        <option value="5">Bank Name 5</option>
                        <option value="6">Bank Name 6</option>
                        <option value="7">Bank Name 7</option>
                        <option value="8">Bank Name 8</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="accountName" class="form-label">Account Name</label>
                      <input type="text" class="form-control" data-bv-field="accountName" id="accountName" required="" value="" placeholder="e.g. Saliha Kazmi">
                    </div>
                    <div class="mb-3">
                      <label for="accountNumber" class="form-label">Account Number</label>
                      <input type="text" class="form-control" data-bv-field="accountNumber" id="accountNumber" required="" value="" placeholder="e.g. 12346678900001">
                    </div>
                    <div class="mb-3">
                      <label for="ifscCode" class="form-label">NEFT IFSC Code</label>
                      <input type="text" class="form-control" data-bv-field="ifscCode" id="ifscCode" required="" value="" placeholder="e.g. ABCDE12345">
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" id="remember-me" name="remember" type="checkbox">
                      <label class="form-check-label" for="remember-me">I confirm the bank account details above</label>
                    </div>
                    <div class="d-grid"><button class="btn btn-primary" type="submit"  onclick="hideAddBankAccountModal()">Add Bank Account</button></div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Finish -->


            </div>
          <script>
  function showEditCardModal() {
    $('#edit-card-details').modal('show');
  }

  function hideEditCardModal() {
    $('#edit-card-details').modal('hide');
  }

   function showAddCardModal() {
    $('#add-new-card-details').modal('show');
  }

  // Function to hide the Add Card modal
  function hideAddCardModal() {
    $('#add-new-card-details').modal('hide');
  }

  function showBankAccountModal() {
    $('#bank-account-details').modal('show');
  }

  function hideBankAccountModal() {
    $('#bank-account-details').modal('hide');
  }

  function showAddBankAccountModal() {
    $('#add-new-bank-account').modal('show');
  }

  // Function to hide the modal (if needed)
  function hideAddBankAccountModal() {
    $('#add-new-bank-account').modal('hide');
  }
           </script>
@endsection
@section('page-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
