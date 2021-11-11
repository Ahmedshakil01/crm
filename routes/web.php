<?php

use Illuminate\Support\Facades\Route;


Route::get('updatecommon', 'CommonController@updateSlug');
// customer route
Route::group(['prefix'=>'customer', 'namespace' => 'Customer'], function () {
    Route::get('/mailbox', 'MailboxController@index')->name('customer.mailbox');
    Route::get('/maildetails/{id}','MailboxController@details')->name('customer.maildetails');
    Route::get('/newmail','MailboxController@newMail')->name('seller.newmail');
    Route::post('/newmailaction','MailboxController@mailSendAction')->name('seller.newmailaction');
    Route::get('/sentmail','MailboxController@sentmail')->name('seller.sentmail');
    Route::get('/draftmail','MailboxController@draftmail')->name('seller.draftmail');
    Route::post('/mailreply','MailboxController@mailReply')->name('seller.mailreply');
});

Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
Route::group(['prefix' => 'administration','namespace'=> 'Admin','middleware' => 'auth:administration'], function()
{
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::resource('admins','AdminController');

    Route::get('/mailbox','MailboxController@inbox')->name('admin.mailbox');
    Route::get('/maildetails/{id}','MailboxController@details')->name('admin.maildetails');
    Route::get('/newmail','MailboxController@newMail')->name('admin.newmail');
    Route::post('/newmailaction','MailboxController@mailSendAction')->name('admin.newmailaction');
    Route::get('/sentmail','MailboxController@sentmail')->name('admin.sentmail');
    Route::get('/draftmail','MailboxController@draftmail')->name('admin.draftmail');
    Route::any('/getautosellers', 'MailboxController@autocomplete')->name('admin.getautosellers');
    Route::post('/mailreply','MailboxController@mailReply')->name('admin.mailreply');
    Route::get('/mailreply','MailboxController@allMailReply')->name('admin.all-replies');

	Route::get('customer/details/{id}', 'CustomerAdminController@customer_details')->name('admin.customer.details');
	Route::get('customer/edit/{id}', 'CustomerAdminController@customer_edit')->name('admin.customer.edit');
	Route::post('customer/update/{id}', 'CustomerAdminController@customer_update')->name('admin.customer.update');
	Route::get('customer/total_orders/{seller_id}', 'CustomerAdminController@total_orders')->name('admin.customer.total_orders');
	Route::get('customer/unshipped_orders/{seller_id}', 'CustomerAdminController@unshipped_orders')->name('admin.customer.unshipped_orders');
	Route::get('customer/complete_orders/{seller_id}', 'CustomerAdminController@complete_orders')->name('admin.customer.complete_orders');
	Route::get('customer/canceled_orders/{seller_id}', 'CustomerAdminController@canceled_orders')->name('admin.customer.canceled_orders');
	Route::get('customer/returned_orders/{seller_id}', 'CustomerAdminController@returned_orders')->name('admin.customer.returned_orders');
    Route::get('customer/ajaxfilter/', 'CustomerAdminController@ajaxfilter');

    //customer order report
    Route::get('customer/order/report', 'CustomerAdminController@customer_order_report')->name('customer.order.report');
    Route::get('order/ajaxfilter/', 'CustomerAdminController@order_ajax');



    Route::get('companyprofile','CompanyProfileController@edit')->name('companyprofile.edit');
	Route::post('companyprofile/{id}','CompanyProfileController@update')->name('companyprofile.update');
	Route::get('ajaxstate','CompanyProfileController@searchajax')->name('ajaxstate');

    Route::get('getAllPermission', 'PermissionController@getPermission');

	Route::resource('customer','CustomerAdminController');
    // Lead Controller Route
	Route::resource('lead','LeadController');
	Route::post('lead/{id}','LeadController@update')->name('admin.lead.update');
	Route::get('lead/details/{id}','LeadController@lead_details')->name('admin.lead.details');

    // Contact Controller Route
	Route::resource('contact','ContactController');
	Route::post('contact/{id}','ContactController@update')->name('admin.contact.update');
	Route::get('contact/details/{id}','ContactController@contact_details')->name('admin.contact.details');
	Route::post('contact/details/{id}','ContactController@contact_details')->name('admin.contact.details');
    
    // Contact Controller Route
	Route::resource('quote','QuoteController')->except([
        'create'
    ]);

	Route::get('quote/create/{id}','QuoteController@create')->name('admin.quate.create');
	Route::get('quote/details/{id}','QuoteController@quote_details')->name('admin.quote.details');
	Route::get('quote/print/{id}','QuoteController@quote_print')->name('admin.quote.print');



    Route::resource('merchant','MerchantController');

    //sourcetype
    Route::resource('sourceType','SourceTypeController');


    Route::resource('role','RoleController');
    Route::resource('news','NewsController');
    Route::resource('permission','PermissionController');
    Route::resource('group','GroupController');



    Route::resource('ticket_status','TicketStatusController');
	Route::resource('lead_sources','LeadSourceController');
    Route::resource('lead_industry','LeadIndustryController');
    Route::resource('lead_status','LeadStatusController');
    Route::resource('lead_rating','LeadRatingController');
   //**************************************Campaign routes*********************************************************
    Route::any('permissionscampaign', 'CommonController@permissionsCampaign');
    Route::resource('campaign','CampaignController');
    Route::resource('campaign_sub','SubcampaignController');

    Route::any('masterdelete', 'CommonController@deletedata');
	Route::any('permissions', 'CommonController@permissions');
	Route::any('changestatus', 'CommonController@changestatus');
	Route::get('updatecommon', 'CommonController@updateSlug');

    Route::get('generate-code','ProductController@codeGeneration')->name('admin.codegeneration');
    Route::get('add/feature/{id}', 'ProductController@addfeature')->name('admin.add.feature');

	//Notification type
    Route::get('/notification/type','NotificationController@notificationType')->name('notification.type');
    Route::get('/create/notification/type','NotificationController@createNotificationType')->name('create.notification.type');
    Route::post('/notification/type/store','NotificationController@notificationTypeStore')->name('notification.type.store');
    Route::get('/notification/type/edit/{id}','NotificationController@notificationTypeEdit')->name('notification.type.edit');
    Route::post('/notification/type/update','NotificationController@notificationTypeUpdate')->name('notification.type.update');

    //Notification User type
    Route::get('/notification/user/type','NotificationController@notificationUserType')->name('notification.user.type');
    Route::get('/notification/user/type/create','NotificationController@notificationUserTypeCreate')->name('notification.user.type.create');
    Route::post('/notification/user/type/store','NotificationController@notificationUserTypeStore')->name('notification.user.type.store');
    Route::get('/notification/user/type/edit/{id}','NotificationController@notificationUserTypeEdit')->name('notification.user.type.edit');
    Route::post('/notification/user/type/update','NotificationController@notificationUserTypeUpdate')->name('notification.user.type.update');
    Route::post('/notification/user/type/delete','NotificationController@notificationUserTypeDelete')->name('notification.user.type.delete');


    // Email Marketing route here
    Route::get('/index/email','NotificationController@indexNotification')->name('notification.index');
    Route::get('/create/email','NotificationController@createNotification')->name('admin.create.notification');
    Route::post('/marketing/email/store','NotificationController@storeNotification')->name('admin.notification.store');

    // SMS Notification route here
    Route::get('/index/sms-notification','SmsNotificationController@indexNotification')->name('sms-notification.index');
    Route::get('/create/sms-notification','SmsNotificationController@createNotification')->name('admin.create.sms-notification');
    Route::post('/sms-notification/store','SmsNotificationController@storeNotification')->name('sms-notification.store');

    //Notification type
    Route::get('/sms-notification/type','SmsNotificationController@notificationType')->name('sms-notification.type');
    Route::get('/create/sms-notification/type','SmsNotificationController@createNotificationType')->name('create.sms-notification.type');
    Route::post('/sms-notification/type/store','SmsNotificationController@notificationTypeStore')->name('sms-notification.type.store');
    Route::get('/sms-notification/type/edit/{id}','SmsNotificationController@notificationTypeEdit')->name('sms-notification.type.edit');
    Route::post('/sms-notification/type/update','SmsNotificationController@notificationTypeUpdate')->name('sms-notification.type.update');

    //SMS Notification Template type
    Route::get('/sms-notification/template','SmsNotificationController@notificationTemplate')->name('sms-notification.template');
    Route::get('/create/sms-notification/template','SmsNotificationController@createNotificationTemplate')->name('create.sms-notification.template');
    Route::post('/sms-notification/template/store','SmsNotificationController@notificationTemplateStore')->name('sms-notification.template.store');
    Route::get('/sms-notification/template/edit/{id}','SmsNotificationController@notificationTemplateEdit')->name('sms-notification.template.edit');
    Route::post('/sms-notification/template/update','SmsNotificationController@notificationTemplateUpdate')->name('sms-notification.template.update');
    Route::post('/sms-notification/template/ajax','SmsNotificationController@notificationTypeAjax')->name('sms-notification.template.ajax');

    // Email Template Type
    Route::get('/email-template/type','EmailTemplateTypeController@emailTemplateType')->name('admin.email-template.type');
    Route::get('/create/email-template/type','EmailTemplateTypeController@createEmailTemplateType')->name('admin.create-email-template.type');
    Route::post('/email-template/type/store','EmailTemplateTypeController@storeEmailTemplateType')->name('admin.email-template.type.store');
    Route::get('/email-template/type/edit/{id}','EmailTemplateTypeController@emailTemplateTypeEdit')->name('admin.email-template.type.edit');
    Route::post('/email-template/type/update','EmailTemplateTypeController@emailTemplateTypeUpdate')->name('admin.email-template.type.update');

    // Email Template
    Route::get('/email/template','EmailTemplateController@emailTemplate')->name('admin.email.template');
    Route::get('/create/email/template','EmailTemplateController@createEmailTemplate')->name('admin.create.email-template');
    Route::post('/email/template/store','EmailTemplateController@emailTemplateStore')->name('admin.email.template.store');
    Route::get('/email/template/edit/{id}','EmailTemplateController@emailTemplateEdit')->name('admin.email-template.edit');
    Route::post('/email/template/update','EmailTemplateController@emailTemplateUpdate')->name('admin.email.template.update');
    //Ajax
    Route::post('/email/template/ajax','NotificationController@emailTypeAjax')->name('admin.email.template.ajax');
	
	
	
	
	//Attachments
	Route::get('/attachment','AttachmentController@index')->name('attachment.index');
    Route::post('/attachment/store','AttachmentController@store')->name('attachment.store');
	
	Route::get('/note','NoteController@index')->name('note.index');
    Route::post('/note/store','NoteController@store')->name('note.store');
	Route::post('/note/update','NoteController@update')->name('note.update');
	
	Route::get('/meeting','MeetingController@index')->name('meeting.index');
    Route::post('/meeting/store','MeetingController@store')->name('meeting.store');
	Route::post('/meeting/update','MeetingController@update')->name('meeting.update');
	
	
	Route::get('/email','EmailController@index')->name('email.index');
    Route::post('/email/store','EmailController@store')->name('email.store');
	Route::post('/email/update','EmailController@update')->name('email.update');
	
	//Common download
	Route::get('/samplefiledownload','AttachmentController@sampleFileDownload')->name('attachment.samplefiledownload');
});

require __DIR__.'/auth.php';
