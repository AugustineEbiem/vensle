<?php
return "";
// use Models\Functions;

// $names = explode('/', $_SERVER['SCRIPT_NAME']); 
// $page = end($names);
// $outers = "<div class='inbox-leftbar'>

// <!-- <a class='btn btn-danger btn-block' href='message_compose.php'>Composer</a> -->

// <div class='mail-list mt-4'>

//     <a class='list-group-item border-0 ";
//     $outers .= ($page == 'message_inbox.php')?'text-danger actived':'';
//     $outers .= " href='".Functions::getPageUrl()."message-inbox'><i class='mdi mdi-inbox font-18 align-middle mr-2'></i><b>Inbox</b> ";
//     $get_noti = Functions::getNotificationMessages();
//     if($get_noti){
//         $noti_count = count($get_noti);
//     }else{
//         $noti_count = 0;
//     }
//     if($noti_count!=0) {
//         $outers .= "<span class='label label-danger float-right ml-2'>{$noti_count}</span>";
//     }
//     $outers .= " </a>

//     <a class='list-group-item border-0' href='message_draft.php'><i class='mdi mdi-file-document-box font-18 align-middle mr-2'></i>Draft</a>

//     <a class='list-group-item border-0";
//     $outers .= ($page == 'message_sent.php')?'text-danger actived':'';
//     $outers .= "' href='message_sent.php'><i class='mdi mdi-send font-18 align-middle mr-2'></i>Sent Mail</a>

//     <a class='list-group-item border-0' href='message_trash.php'><i class='mdi mdi-delete font-18 align-middle mr-2'></i>Trash</a>

// </div>

// </div>";
// return $outers;