<?php
$out = include "src/Views/homenav.php";
$out .= "
<!-- Start of Main -->
        <main class='main'>
            <!-- Start of Page Header -->
            <div class='page-header' style='height: 180px;'>
                <div class='container'>
                    <h1 class='page-title mb-0'>FAQs</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class='breadcrumb-nav mb-10 pb-1'>
                <div class='container'>
                    <ul class='breadcrumb'>
                        <li><a href='{$this->page->link}'>Home</a></li>
                        <li>FAQs</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class='page-content faq'>
                <div class='container'>
                    <section class='content-title-section'>
                        <h3 class='title title-simple justify-content-center bb-no pb-0'>Frequent Asked
                            Questions
                        </h3>
                        <p class='description text-center'>Questions our customers ask frequently.</p>
                    </section>

                        <h4 class='title title-center mb-5'>General Information</h4>
                        <div class='row'>
                            <div class='col-md-6 mb-8'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse1-1' class='collapse'>What is vensle.com all about?</a>
                                        </div>
                                        <div id='collapse1-1' class='card-body expanded'>
                                            <p class='mb-0'>Vensle.com is an online marketplace that bring buyers and sellers in a neighbourhood together. You can display all the product you sell if you have a shop and you can also sell off your personal used items as an individual. It is very easy to use. If you're not cleared enough and you still want to make more findings, please feel free to send us your questions via <a href = 'mailto: info@vensle.com'>info@vensle.com</a>.
                                            </p>
                                        </div>
                                    </div>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse1-2' class='expand'>Are there products I cannot sell or request on vensle.com?</a>
                                        </div>
                                        <div id='collapse1-2' class='card-body collapsed'>
                                            <p class='mb-0'>div class='panel-body'>
                                            Yes there are products you cannot sell or request on vensle.com. Products like ammunition of any kind, drugs, pornographic contents of all types and any contraband according to the law of your locality are all prohibited on vensle.com. To better understand this please read the <a href='{$this->page->link}/policy/terms-conditions'>Terms and Conditions of use</a>.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 mb-8'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse1-3' class='collapse'>How can I make my product among the featured products that displays on the homepage?</a>
                                        </div>
                                        <div id='collapse1-3' class='card-body expanded'>
                                            <p class='mb-0'> The featured products are selected at random and it can be anyone's product. However you can ensure the picture of your product is clear enough and the category is properly chosen to stand a chance of your product being selected among the featured products.
                                            </p>
                                        </div>
                                    </div>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse1-4' class='expand'>Why must product be pending when I upload?</a>
                                        </div>
                                        <div id='collapse1-4' class='card-body collapsed'>
                                            <p class='mb-0'>Fringilla urna porttitor rhoncus dolor purus. Luctus venenatis lectus  semper bibendum
                                            This is to avoid the upload of dirty, pornographic and contents that are disturbing. As much as possible we want to make vensle.com a comfortable platform for all users.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6 mb-4'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse2-1' class='collapse'>How can I upload my product on vensle.com?</a>
                                        </div>
                                        <div id='collapse2-1' class='card-body expanded'>
                                            <p class='mb-0'>It is very easy to upload your product on vensle.com. You can click on the Upload an item on the menu bar or you can go to the dashboard and click the product tab on the side bar (if you are using a mobile device or a tablet and you can't see the side bar please click on the expand button so you can see the side bar). Then click on <strong>upload new item</strong>, fill in the details and upload. That's all.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse2-2' class='collapse'>Can I upload an item without registering or creating an account?</a>
                                        </div>
                                        <div id='collapse2-2' class='card-body expanded'>
                                            <p class='mb-0'>No please. You can't. You must create an account before you can upload any item.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-md-6 mb-8'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-1' class='collapse'> Must I put my home address when uploading an item?</a>
                                        </div>
                                        <div id='collapse3-1' class='card-body expanded'>
                                            <p class='mb-0'> You mustn't. It is not compulsory for you to put your home address if you have any fear of security risk. However, you can put your street address or the most public convenient and closest location to you.
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-3' class='expand'> How do I know the group and category my product falls into?</a>
                                        </div>
                                        <div id='collapse3-3' class='card-body collapsed'>
                                            <p class='mb-0'>It is very easy. Just choose a group you think best suits your item and search for the category it falls into or search in your most convenient search engine and then come back and choose the group it falls into.
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-5' class='expand'> Can I upload an item without an image? What if I don't have a picture?</a>
                                        </div>
                                        <div id='collapse3-5' class='card-body collapsed'>
                                            <p class='mb-0'>No you can't. All items posted on vensle.com must have pictures. If you can't snap then try getting pictures of same item in your favourite search engine.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 mb-8'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-2' class='collapse'> What is the meaning of place a request</b> and how does it work?</a>
                                        </div>
                                        <div id='collapse3-2' class='card-body expanded'>
                                            <p class='mb-0'> Place a request is used when a buyer wishes to buy something and he or she has a particular budgeted amount for it. Most sellers that have items to sell usually check if anyone has placed a request on the items they have so they could easily call them and sell to them (most times at cheaper price) instead of displaying it for buyers to contact them.
                                            </p>
                                        </div>
                                    </div>
        
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-4' class='expand'> Is place a request not risky, since the public knows what I want to buy?</a>
                                        </div>
                                        <div id='collapse3-4' class='card-body collapsed'>
                                            <p class='mb-0'>Place a request is not supposed to be risky. However, if you feel you have a security risk in you location you can use a public address as your meeting point with the seller. You must not use your exact house address.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class='row'>
                            <div class='col-md-6 mb-8'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-1' class='collapse'> Why do I need to upload a picture when placing a request?</a>
                                        </div>
                                        <div id='collapse3-1' class='card-body expanded'>
                                            <p class='mb-0'> This is because most sellers prefer to have a picture of the exact item you need. If you need a picture, please try downloading them at your most convenient search engine.
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-3' class='expand'> Is there any security risk in using this platform?</a>
                                        </div>
                                        <div id='collapse3-3' class='card-body collapsed'>
                                            <p class='mb-0'>There are presently no security risks of any kind reported so far on this platform. However, no one can be too careful. It is very essential for you to avoid any risk of any kind. It is advised that you avoid meeting buyers or sellers in areas that are dangerous. 
                                            </p>
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-5' class='expand'> Which of my informations are private and which are shown to the public?</a>
                                        </div>
                                        <div id='collapse3-5' class='card-body collapsed'>
                                            <p class='mb-0'>Your email is private. All other information which are your name, your address, phone number, your profile picture and store/business name are available to the public.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-6 mb-8'>
                                <div class='accordion accordion-bg accordion-gutter-md accordion-border'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-2' class='collapse'> How secure are the informations I provide during registration?</a>
                                        </div>
                                        <div id='collapse3-2' class='card-body expanded'>
                                            <p class='mb-0'>  Your only secure information is your email address and in no condition will vensle.com sell your email address. The only reason we ask for your email account is for the purpose of recovering your password should you ever forget it.
                                            </p>
                                        </div>
                                    </div>
        
                                    <div class='card'>
                                        <div class='card-header'>
                                            <a href='#collapse3-4' class='expand'> How shall these things be?</a>
                                        </div>
                                        <div id='collapse3-4' class='card-body collapsed'>
                                            <p class='mb-0'>Thou shall not doubt. Marvel not that I saith unto thee that these things shall be.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->


";
$out .= include "homefooter.php";
return $out;