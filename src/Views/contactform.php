<?php
$out = include "src/Views/homenav.php";
$out .= "
<!-- Start of Main -->
<main class='main'>
    <!-- Start of Page Header -->
    <div class='page-header'>
        <div class='container'>
            <h1 class='page-title mb-0'>Contact Us</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class='breadcrumb-nav mb-10 pb-1'>
        <div class='container'>
            <ul class='breadcrumb'>
                <li><a href='{$this->page->link}'>Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->


    <!-- Start of PageContent -->
    <div class='page-content contact-us'>
        <div class='container'>
            <section class='content-title-section mb-10'>
                <h3 class='title title-center mb-3'>Contact
                    Information
                </h3>
                <p class='text-center'>
                Do you have enquiries or concerns? Use the form below to send a message to us and we would respond soon
                </p>
            </section>
            <!-- End of Contact Title Section -->

            <section class='contact-information-section mb-10'>
                <div class=' swiper-container swiper-theme ' data-swiper-options=\"{
                    'spaceBetween': 20,
                    'slidesPerView': 1,
                    'breakpoints': {
                        '480': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '992': {
                            'slidesPerView': 4
                        }
                    }
                }\">
                    <div class='swiper-wrapper row cols-xl-4 cols-md-3 cols-sm-2 cols-1'>
                        <div class='swiper-slide icon-box text-center icon-box-primary'>
                            <span class='icon-box-icon icon-email'>
                                <i class='w-icon-envelop-closed'></i>
                            </span>
                            <div class='icon-box-content'>
                                <h4 class='icon-box-title'>E-mail Address</h4>
                                <p>support@vensle.com</p>
                            </div>
                        </div>
                        <div class='swiper-slide icon-box text-center icon-box-primary'>
                            <span class='icon-box-icon icon-headphone'>
                                <i class='w-icon-headphone'></i>
                            </span>
                            <div class='icon-box-content'>
                                <h4 class='icon-box-title'>Phone Number</h4>
                                <p>(234) 9035813821</p>
                            </div>
                        </div>
                        <div class='swiper-slide icon-box text-center icon-box-primary'>
                            <span class='icon-box-icon icon-map-marker'>
                                <i class='w-icon-map-marker'></i>
                            </span>
                            <div class='icon-box-content'>
                                <h4 class='icon-box-title'>Address</h4>
                                <p>Lawrence, NY 11345, USA</p>
                            </div>
                        </div>
                        <div class='swiper-slide icon-box text-center icon-box-primary'>
                            <span class='icon-box-icon icon-fax'>
                                <i class='w-icon-fax'></i>
                            </span>
                            <div class='icon-box-content'>
                                <h4 class='icon-box-title'>Fax</h4>
                                <p>1-800-570-7777</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of Contact Information section -->

            <hr class='divider mb-10 pb-1'>

                    <section class='contact-section'>
                        <div class='row gutter-lg pb-3'>
                            <div class='col-lg-6 mb-8'>
                                <h4 class='title mb-3'>People usually ask these questions</h4>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse1' class='collapse'>What is vensle.com all about?</a>
                                        </div>
                                        <div id='collapse1' class='card-body expanded'>
                                            <p class='mb-0'>
                                            Vensle.com is an online marketplace that bring buyers and sellers in a neighbourhood together. You can display all the product you sell if you have a shop and you can also sell off your personal used items as an individual. It is very easy to use. If you're not cleared enough and you still want to make more findings, please feel free to send us your questions via info@vensle.com.
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse2' class='expand'>Are there products I cannot sell or request on vensle.com?</a>
                                        </div>
                                        <div id='collapse2' class='card-body collapsed'>
                                            <p class='mb-0'>
                                            Yes there are products you cannot sell or request on vensle.com. Products like ammunition of any kind, drugs, pornographic contents of all types and any contraband according to the law of your locality are all prohibited on vensle.com. To better understand this please read the Terms and Conditions of use.
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3' class='expand'>How can I make my product among the featured products that displays on the homepage?</a>
                                        </div>
                                        <div id='collapse3' class='card-body collapsed'>
                                            <p class='mb-0'>
                                            The featured products are selected at random and it can be anyone's product. However you can ensure the picture of your product is clear enough and the category is properly chosen to stand a chance of your product being selected among the featured products.
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse4' class='expand'>Why must product be pending when I upload?</a>
                                        </div>
                                        <div id='collapse4' class='card-body collapsed'>
                                            <p class='mb-0'>
                                            This is to avoid the upload of dirty, pornographic and contents that are disturbing. As much as possible we want to make vensle.com a comfortable platform for all users.
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse5' class='expand'>How can I upload my product on vensle.com?</a>
                                        </div>
                                        <div id='collapse5' class='card-body collapsed'>
                                            <p class='mb-0'>
                                            It is very easy to upload your product on vensle.com. You can click on the Upload an item on the menu bar or you can go to the dashboard and click the product tab on the side bar (if you are using a mobile device or a tablet and you can't see the side bar please click on the expand button so you can see the side bar). Then click on upload new item, fill in the details and upload. That's all.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-6 mb-8'>
                                <h4 class='title mb-3'>Send Us a Message</h4>
                                <form class='form contact-us-form' action='{$this->page->link}/contact' method='post'>
                                {$message}
                                {$errors}
                                    <div class='form-group'>
                                        <label for='username'>Your Name</label>
                                        <input type='text' name='contact_name' value='' placeholder='Name *' class='form-control form-control-alternative valid' aria-required='true' aria-describedby='val-email-error' aria-invalid='false' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='email_1'>Your Email</label>
                                        <input type='email' name='contact_email' value='' placeholder='Email *' class='form-control form-control-alternative valid' aria-required='true' aria-describedby='val-email-error' aria-invalid='false' required>
                                    </div>
                                      <div class='select-box'>
                                      <select required name='contact_title' class='form-control form-control-md' required>
                                      <option>Select an option:</option>
                                                    <option value='Complain'>Complain</option>
                                                    <option value='Abuse Report'>Report Abuse</option>
                                                    <option value='Need Help'>Need Help</option>
                                                    <option value='Question'>Question</option>
                                                </select>
                                      </div>
                                    <div class='form-group'>
                                        <label for='message'>Your Message</label>
                                        <textarea id='message' type='text' name='contact_message' cols='30' rows='5' value='' placeholder='Message *' class='form-control form-control-alternative valid' aria-required='true' required></textarea>
                                       
                                    </div>
                                    <button type='submit' name='contact_submission' class='btn btn-dark btn-rounded'>Send Now</button>
                                </form>
                            </div>
                        </div>
                    </section>
                    <!-- End of Contact Section -->
                </div>

                                
                 
                  <form class='form-valide' role='form' action='{$this->page->link}/contact' method='post' >
";
$out .= include "homefooter.php";
return $out;