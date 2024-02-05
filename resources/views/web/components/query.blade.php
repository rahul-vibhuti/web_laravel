   <section class="formSection">
       <div class="container">
           <div class="innerBox">
               <div class="row formRow">
                   <div class="col-md-6">
                       <p class="paraHeading">Let's Talk Your Business</p>
                       <p class="commonPara">
                           <span class="d-block">Prenons contact pour échanger sur vos besoins et vos défis
                               tech.
                           </span>
                           Nous serions heureux d’en connaître un peu plus sur votre projet
                           de site, d’application ou de solution SaaS.
                       </p>
                   </div>
                   <div class="col-md-6">

                       <div class="allData">
                           <div class="leftContent">
                               <ul class="mainlistItems">
                                   <li class="commonPara">
                                       <span><img src="Images/skype.png" alt="img" /></span>
                                       Skype <strong>xyz@gmail.com</strong>
                                   </li>
                                   <li class="commonPara">
                                       <span><img src="Images/gmail.png" alt="img" /></span>
                                       Gmail <strong>xyz@gmail.com</strong>
                                   </li>
                                   <li class="commonPara">
                                       <span><img src="Images/whatsapp.png" alt="img" /></span>
                                       whatsapp <strong>3678578278</strong>
                                   </li>
                                   <li class="commonPara">
                                       <span><img src="Images/instagram.png" alt="img" /></span>
                                       instagram
                                       <strong>digital-marketing134</strong>
                                   </li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-12" style="margin-top: 40px">
                       <div class="formMain">
                           <p class="listH commonPara">
                               <strong> Tell us more about your needs</strong>
                           </p>
                           <form id="subcription_form" name="registration" action="#">
                               <fieldset>
                                   <div class="row">
                                       <div class="col-6">
                                           <input class="effect-2" type="text" placeholder="Full Name" />
                                           <span class="focus-border"></span>
                                       </div>
                                       <div class="col-6">
                                           <input class="effect-2" type="text" placeholder="Email" />
                                           <span class="focus-border"></span>
                                       </div>
                                       <div class="col-6">
                                           <input class="effect-2" type="text" placeholder="Mobile Number" />
                                           <span class="focus-border"></span>
                                       </div>
                                       <div class="col-12">
                                           <textarea class="effect-2" placeholder="Describe your project"></textarea>
                                           <span class="focus-border"></span>
                                       </div>
                                   </div>
                               </fieldset>
                           </form>
                       </div>
                   </div>
                   <div class="col-sm-12 tags">
                       <div class="form-inline nowrap form-service-row">
                           <label class="cmr-label">Services</label>
                       </div>
                       <div class="checkform servicesList" >
                           @foreach ($services as $service )

                           <div class="formServiceItem">
                               <input type="checkbox" class="myCheckbox" name="services[]" id="service_{{ $service->id }}" value="{{ $service->id }}" /><label for="service_{{ $service->id }}">{{ $service->name }}</label>
                           </div>
                           @endforeach

                       </div>
                   </div>
                   <div class="col-md-12">
                       <div class="inquiryBtn">
                           <div class="form-inline d-block">
                               <div class="file-upload">
                                   <div class="custom-file">
                                       <input id="document" name="document[]" class="custom-file-input" label="document" aria-label="file" type="file" total-max-size="10485760" multiple="" />
                                       <p class="custom-file-label">Attach File</p>
                                   </div>

                               </div>
                           </div>
                           <div id="files-area">
                               <span id="filesList"><span id="files-names"></span></span>
                               <p class="pt-3">Please upload .jpg or .png or .pdf or .jpeg as document.</p>
                           </div>
                           <div class="inquiryBtnOuter">
                               <input type="text" id="phone-number" name="phone-number" value="" style="display: none" />
                               <button class="primary-btn hvr-shutter-out-horizontal ml-lg-auto" id="contact-submit">
                                   Send <i class="fas fa-solid fa-arrow-right"></i>
                                   <span class="btnloader"></span>
                               </button>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>