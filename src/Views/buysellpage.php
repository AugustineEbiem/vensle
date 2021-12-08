<?php
$out = include "src/Views/homenav.php";
$out .= "

  <div class='' id='services'> 
    <div class='page'>
      <div class='page-header'>
        <h1 class='page-title'>Sell and Buy Guide</h1>
      </div>
      <div class='page-content container-fluid'>
        <div class='row'>
        <div class='tab tab-vertical tab-nav-solid '>
      <ul class='nav nav-tabs' role='tablist'>
         <li class='nav-item'>
             <a class='nav-link active' href='#welcome'>Welcome</a>
         </li>
         <li class='nav-item'>
             <a class='nav-link' href='#home'> Home Page</a>
         </li>
         <li class='nav-item'>
             <a class='nav-link' href='#page'>View More Page</a>
         </li>
         <li class='nav-item'>
             <a class='nav-link' href='#profile'>Sellers' Profile</a>
         </li>
         <li class='nav-item'>
             <a class='nav-link' href='#dashboard'>Dashboard</a>
         </li>
         <li class='nav-item'>
             <a class='nav-link' href='#products'>Products</a>
         </li>
         <li class='nav-item'>
             <a class='nav-link' href='#settings'>Settings</a>
         </li>
         <li class='nav-item'>
             <a class='nav-link' href='#message'>Message</a>
         </li>
      </ul>
      <div class='tab-content'>
        <div class='tab-pane active' id='welcome'>
           <h5>INTRODUCTION</h5><hr>
             <div class='panel-body'>
             Welcome to the guide on how to use the vensle.com online market platform. This comprehensive guide is to give you a good understanding of how to use this platform. On the left is a sidebar of the list of topics covered (if you're using a tablet or a smart phone the side bar will be at the top). The list of headings cover are <b> Welcome, Home Page, View More Page, Customers Profile, Dashboard, Products, Settings and Message. </b>You can navigate through these topics until you're cleared of any doubts and if you feel you're no satisfied please visit our <a href='{$this->page->link}/faq'>frequently asked question (FAQ)</a> or <a href='{$this->page->link}/contact'>contact us</a> and we will be glad to attend to you.
             <hr>
              <h5> The Menu Tabs</h5>
              <hr>
              The logo <img src='{$this->page->link}/vensle-assets/images/logo2.png' style=' width: 90px; ' alt='vensle Logo'> will take you to the home page when you click it from any page within the website .
              <p></p> The search bar is to guide you to search for any item you want. You can search by the name of the product, the description or by the location.
              <p></p>The <span class='nav-item nav-link pr-0 mr-0 e ' style='color: black;'><i class='w-icon-account'></i> Sign in | Register </span> button is quite self explanatory. The purpose is simply for you to login if you're already registered or for you to register if you've never registered before. On clicking it, a pop up box will appear so you can easily login or register without having to leave the page where you are currently. If you didn't see the pop up then that's because the javascript of your browser is turned off. Please turn it on.
              <p></p>The <span class='nav-item nav-link pr-0 mr-0 fa fa-upload e' style='color: black;'> Upload an Item </span> button is a very easy shortcut for you to click and be taken to the upload page direct for easy upload of items. However, you must be logged in before you can upload an item. If you haven't loggin already and you click it you will be required to login.
              <p></p>The <span class='nav-item nav-link pr-0 mr-0 fa fa-money e ' style='color: black;'> Sell/Buy Tutorial</span> button takes you to this page you're currently in. Designed to guide you on how to use the website. 
              <p></p>The <span class='nav-item nav-link pr-0 mr-0 fa fa-shopping-basket e' style='color: black;'> Place a Request </span> button is meant to take you directly to the page where you can place a request. 
            </div>
        </div>
        <div class='tab-pane' id='home'>
          <h5>GROUP DISPLAY OF PRODUCTS</h5><hr>
           <div class='panel-body'>
            There are 12 groups of item displayed. These groups are quick and brief view of examples of most popular items displayed in them. By clicking any of the group pictures, it will take you to the products in those groups. You can narrow then down by adjusting the search bar. 
            <hr><h5>USERS PRODUCTS</h5><hr>
            The users products are the display of the items of users. These items are in two categories. Some displayed in twelve and some in six. You can use the right arrow to see more. Please note these displays are not all but just a sample of users items you can buy.
              <p></p>Each item is displayed in different colours of buttons under them. These coulours represent the present condition of the item which are <span class='badge badge-success'>NEW</span>, <span class='badge badge-primary'>USED</span> and <span class='badge badge-secondary'>NOT APPLICABLE</span>. Not Applicable are for items that does not fall into the category of new or used items. An example is a car hiring service. Their item is a service that is neither new nor used.
                          <p></p>When you click on any of the items, a popup box appears with a brief information of the item with two buttons at the bottom. The <button type='button' class='btn btn-primary'>View More</button>  button takes you to a page where all the details you need about the seller or buyers while the <button type='button' class='btn btn-secondary' data-dismiss='modal'>Back</button> button simply returns you back to continue checking out other items.
                          </div>   
         </div>
         <div class='tab-pane' id='page'>
         <h5>PRODUCT FEATURES</h5><hr>
         <div class='panel-body'>
            The features of the product are all under the category below.
            <p></p><b>Product:</b> is the name of the item. Group: refers to the group the item falls into. 
            <p></p><b>Category:</b> is the smaller division of the item.
            <p></p><b>Condition:</b> is the status of the item which can either be <span class='badge badge-success'>NEW</span>, <span class='badge badge-primary'>USED</span> or <span class='badge badge-secondary'>NOT APPLICABLE</span>.
            <p></p><b>Ref No.:</b> is a special number specifically assigned to that item. You can use it to make reference anytime you contact customer care or the seller/buyer. 
            <p></p><b>Price:</b> is the cost of the item 
            <p></p>Mobile: is the contact of the person that wants to sell/buy the product. 
            <p></p><b>Address:</b>  is the meeting location or the most covenient meeting point.
            <hr><h5>PRODUCT DESCRIPTION</h5><hr>
            This section contains more details about the item .
            <hr><h5>SELLERS DETAILS</h5><hr>
            This section contails a quick view of the <i class='fa fa-user e'> Seller's Name</i>, <i class='fa fa-mobile e'> Contact number</i> and <i class='fa fa-map-marker e'> Sellers Address</i>
            <p></p> <i class='fa fa-user-plus'> View Profile</i> is the button that takes you to the page that contains details of other products and the history of the seller.
            <p></p> <i class='fa fa-comments-o'> Chat Seller</i> is the button that takes you to the messaging section where you can send message directly to the seller 
            <p></p> <b>Similar Products</b> and <b>Recently Viewed Item</b> are quite self explanatory
          </div>
        </div>
        <div class='tab-pane' id='profile'>
          <h5>SELLER'S DETAILS</h5><hr>
          <div class='panel-body'>
              On the left side bar are the details of the seller and and below it is a <i class='fa fa-comments-o'> Chat Seller</i> is the button that takes you to the messaging section where you can send message directly to the seller. 
              <p></p> <b>Active Products</b> are items that the seller presently have for sale while
              <p></p> <b>Sold Products</b> are items that the seller has already sold out. This is just to give you a history of the kind of items the seller sells.
            </div>
             
        </div>
        <div class='tab-pane' id='dashboard'>
          <h5>USER'S DASHBOARD</h5><hr>
          <div class='panel-body'>
          The dashboard is a brief summary of all the items you have in the system.
          <hr><h5>MENU TAB</h5><hr>
          The logo <img src='../backend/images/fav.gif' style=' height: 30px; ' alt='vensle Logo'><img src='../backend/images/logo4.png' style=' width: 90px; ' alt='vensle Logo' > will take you to the home page when you click it from any page within the website.
          <p></p>The <i class='fa fa-bell'></i> icon is for notifications when orders are placed.
          <p></p>The <i class='fa fa-envelope'></i> icon is for ease access to your messages from any where in the site.
          <p></p>The <i class='fa fa-user-circle-o profile-pic prflPcImg'></i> icon which can be your profile picture if you have any picture uploaded is for a quick shortcut to the most used features which include: 
              <i class='fa fa-user'></i> <b>Profile</b> where you can update your profile, 
              <i class='fa fa-credit-card'></i> <b>Go back to Website</b> takes you to the homepage, 
              <i class='fa fa-inbox'></i> <b>Inbox</b> takes you to your messages, 
              <i class='fa fa-cog'></i> <b>Setting</b> takes you to the settings of your password and 
              <i class='fa fa-power-off'></i> <b>Logout</b> that logs you out of the system.
          <hr><h5>LEFT SIDE BAR</h5><hr>
          The section consist of the Dashboard Tab, Products (Collapsed) Tab, Settings (Collapsed) Tab and Message (Collapsed) Tab. To expand the Collapsed Tabs please click them and the list of menus under them will display. The next three sections will explain them more.
          <hr><h5>MID-CONTENT</h5><hr>
          The product box shows you the total number of items you have displayed on the website, <b>Most Recent Items</b> below shows you few of your your displayed products if you have any. If you don't have any, that section will be blank. <b>View all</b> is a shortcut to view all the items you have uploaded.
          </div>

        </div>
        <div class='tab-pane' id='products'>
          <h5>PRODUCTS</h5><hr>
          <div class='panel-body'>
            You need to click the <b>PRODUCTS</b> tab for the list of menus under it to display. These menus are explained below:
            <hr><h5>Upload New Item</h5><hr>
            This is the section where the items you want to display to the public are uploaded.
            <p></p><b>Name of item</b>: This simply means the name of the item you're uploading (example is <em>IPHONE 6</em>). This name should not be longer than 200 letters to avoid being rejected by the system. 
            <p></p><b>Item Condition</b>: Refers to the state of the item you're uploading. It can be  <span class='badge badge-success'>NEW</span> if it hasn't been used before, <span class='badge badge-primary'>USED</span> if it has been used before or <span class='badge badge-secondary'>NOT APPLICABLE</span> if the item you're uploading doesn't fall into this category (example is a Dry Cleaner).
            <p></p><b>Enter Amount</b>: You need to enter the price of item. If its a fixed price then leave it on fixed but if its a negotiable then choose negotiable. If you feel you need to be contacted for price them tick the contact for price button.
            <p></p><b>Group and Category</b>: Group is the bigger division the item you have for sale falls into while the Category is the smaller division. An example is the Iphone 6. It falls into the <b>Group</b> Called <b>Electronics</b> while the <b>Cateogry</b> is called <b>Smart Phones</b>.
            <p></p><b>Description</b>: In this section, you can describe the product you want to sell to the best of your capacity.
            <p></p><b>Contact Phone Number</b>: This is your personal phone number so the buyers can be able to reach out to you easily. A contact number is a neccesary requirement.
            <p></p><b>Region</b>: is the location the item is sold. If you want to sell to other regions (if you have stores in other places) you will need to upload the item again with the other regions.
            <p></p><b>Address</b>: If you have a store, this is the place to enter the address of your store but if you are an individual you mustn't enter your address if you feel unsafe, you can just enter your street address (without a number) or the most public, confortable and closest location to you.
            <p></p><b>Drag and drop pictures here</b>: This section is for you to upload the pictures of the item. The picture must be in jpg, jpeg or png format only.
            <p></p><input type='button' class='btn btn-info btn-xs' value='Save as draft' name=''>: This button helps save your upload for later. When you save as draft, your product will be available in the <b>My Product</b> tab for edit later.
            <p></p><input type='submit' name='submit' class='btn btn-primary' value='Create'>: Clicking the create butoon after filling the whole form will upload your content for review so the administrator can confirm that the uploaded product does not breach our <a href='{$this->page->link}/policy/terms-conditions'>Terms of Use</a>. This process usually takes few minutes
            <hr><h5>My Products</h5><hr>
            This section contain all the items you have uploaded. They are displayed one after the other in a box. Each box contains a picture of the item, the Name, The Address, The Category, The Condition, The Ref No., The Price and the Status of the Item.
            <p></p>This is just a summary of the item you uploaded. The <a class='text-primary' href=''>View on Website</a> button takes you to a more detailed preview of how the item will appear to the general public when they click on them. If you see Approved, it means that your product is approved and live for everone to see but if pending it means its yet to be approved. Declined are items that are rejected by the administration and Draft are products you saved for later.
            <p></p><a class='btn btn-default btn-rounded' href=''><i class='fa fa-edit'></i> Edit</a> is a button that takes you to a page where you can edit the item. The <a class='btn btn-success btn-flat btn-addon btn-xs' href=''><i class='fa fa-handshake-o'></i> Sold</a> is the button you click when the item has been sold but you still want everyone to know that you have sold such items before. Customers that view your profile can still see them if the click on the Sold item button while the <a class='btn btn-danger btn-flat btn-addon btn-xs' href=''><i class='fa fa-close'></i> Delete</a> button is to completely remove it from the system. The Item will be permanently deleted and cannot be restored back.
            <hr><h5>Sold Item</h5><hr>
            This is almost the same as the My Product section. The difference is that the status is offline.
            <hr><h5>Place a Request</h5><hr>
            This section is the same as Upload new item.
            <hr><h5>My Requests</h5><hr>
            This section is the same as My products. The difference is that the items shown here are the ones you requested.
            <hr><h5>Bought Items</h5><hr>
            This section is the same as Sold items. The difference is that they are bought item you still want your customers to see.
          </div>   
        </div>
        <div class='tab-pane' id='settings'>
          <h5>SETTINGS</h5><hr>
          <div class='panel-body'>
            There are two divisions of the settings tab. They are: 
            <hr><h5>UPDATE PROFILE</h5><hr>
            This section lets you upload a profile picture to replace the <i class='fa fa-user-circle-o'></i> to a real picture of your choice. You can also edit you Name, Email, Phone Number and address. When you're done just click <button type='submit' name='submit' class='btn btn-primary'>Update</button>
            <hr><h5>CHANGE PASSWORD</h5><hr>
            This section is for changing your password. You just need to enter your old password and replace it with the new password twice and click <input type='submit' class='btn btn-primary' name='submit' value='Change Password'>.
          </div>
        </div>
        <div class='tab-pane' id='message'>
           <h5>MESSAGE</h5><hr>
             <div class='panel-body'>
              This section is divided into two Categories. They are:
              <hr><h5>COMPOSE</h5><hr>
              This section is for you to compose message to the seller you want to chat. You must have chatted the seller or buyer before now to see the contact details as a suggestion in the address bar. 
              <hr><h5>ALL</h5><hr>
              This section is just showing the message section in full. The Inbox, Draft, Sent Mail, Trash are the contents. It is quite self explanatory.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
";
$out .= include "homefooter.php";
$out .= include "homemodals.php";
return $out;