<?php

namespace App;
use App\Jobs\Email;
use App\Models\{Account, User, Ad, Property, SubscriptionOrder, Ticket};
use Illuminate\Http\Request;

trait Emails{

    public static function sendError(array $content){
        self::email(new Email([
            'emailClass' => 'DefaultMail',
            'to' => env('DEV_EMAIL'),
            'bccStatus' => false,
            'subject' => __("Error occured"),
            'contents' => view('email.exception')->withContent($content)->render(),
        ]));
    }

    public function verifyEmail(User $user, string $link){
        self::email(new Email([
			'emailClass' => 'DefaultMail',
			'to' => $user,
			'subject' => __('Verify email address'),
			'name' => $user->name,
			'contents' => view('email.verify')->withLink($link)->render(),
		]));
    }

    public function accountCreated(Account $user){
        if($user->status == 'pending'){
            self::email(new Email([
                'emailClass' => 'DefaultMail',
                'to' => env('ADMIN_EMAIL'),
                'subject' => __("New User Registration Awaiting Approval"),
                'contents' => view('email.accountCreatedAdmin')->withUser($user)->render(),
            ]));
        }

        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $user->name,
            'to' => $user->email,
            'subject' => __("Account created"),
            'contents' => view('email.accountCreated')->withUser($user)->render(),
        ]));
    }

    public function accountApproved(Account $user){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $user->name,
            'to' => $user->email,
            'subject' => __("Account approved"),
            'contents' => view('email.accountApproved')->withUser($user)->render(),
        ]));
    }

    public function accountSuspended(Account $user){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $user->name,
            'to' => $user->email,
            'subject' => __("Account Subspended"),
            'contents' => view('email.accountSuspended')->withUser($user)->render(),
        ]));
    }

    public function accountDeleted(Account $user){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $user->name,
            'to' => $user->email,
            'subject' => __("Account Deleted"),
            'contents' => view('email.accountDeleted')->withUser($user)->render(),
        ]));
    }

    public function ticketCreated(Ticket $ticket){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => env('ADMIN_EMAIL'),
            'subject' => __("New ticket($ticket->priority) opened by {$ticket->user->name}"),
			'contents' => view('email.ticketAdmin')->withTicket($ticket)->render(),
        ]));
    }

    public function adApproved(Property $ad){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $ad->author->name,
            'to' => $ad->author->email,
            'subject' => __("Property :title approved", ['title' => $ad->name]),
            'contents' => view('email.adApproved')->withAd($ad)->render(),
        ]));
    }

    public function adSuspended(Property $ad){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $ad->author->name,
            'to' => $ad->author->email,
            'subject' => __("Property :title has been suspended", ['title' => $ad->name]),
            'contents' => view('email.adSuspended')->withAd($ad)->render(),
        ]));
    }

    

    public function adPendingReview(Property $ad){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $ad->author->name,
            'to' => $ad->author->email,
            'subject' => __("Property :title is awaiting review", ['title' => $ad->name]),
            'contents' => view('email.adPendingReviewSeller')->withAd($ad)->render(),
        ]));

        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => env('ADMIN_EMAIL'),
            'subject' => __("Property :title is awaiting review", ['title' => $ad->name]),
            'contents' => view('email.adPendingReviewAdmin')->withAd($ad)->render(),
        ]));
    }


    public function adDeleted(Property $ad){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $ad->author->name,
            'to' => $ad->author->email,
            'subject' => __("Property :title has been suspended", ['title' => $ad->name]),
            'contents' => view('email.adDeleted')->withAd($ad)->render(),
        ]));
    }

    public function adRePublished(Property $ad){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $ad->author->name,
            'to' => $ad->author->email,
            'subject' => __("Property :title has been re-published", ['title' => $ad->name]),
            'contents' => view('email.adRePublished')->withAd($ad)->render(),
        ]));
    }

    public function adCompleted(Property $ad){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $ad->author->name,
            'to' => $ad->author->email,
            'subject' => __("Property :title has been completed", ['title' => $ad->name]),
            'contents' => view('email.adCompleted')->withAd($ad)->render(),
        ]));
    }
    
    
    

    public function subscriptionOrderExpired(SubscriptionOrder $order){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $order->seller->name,
            'to' => $order->seller->email,
            'subject' => __("Subscription :plan expired", ['plan' => $order->name]),
            'contents' => view('email.subscriptionOrderExpired')->withOrder($order)->render(),
        ]));
    }

    public function subscriptionOrderExpiring(SubscriptionOrder $order){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'name' => $order->seller->name,
            'to' => $order->seller->email,
            'subject' => __("Subscription :plan expiring soon", ['plan' => $order->name]),
            'contents' => view('email.subscriptionOrderExpiring')->withOrder($order)->render(),
        ]));
    }

    public function freeSubscriptionOrder(SubscriptionOrder $order){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => $order->seller->email,
            'name' => $order->seller->name,
            'subject' => __("Your :plan Subscription is processed", ['plan' => $order->name]),
            'contents' => view('email.sellerSubscriptionOrderFree')->withOrder($order)->render(),
        ]));
    }

    public function subscriptionOrder(SubscriptionOrder $order){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => env('ADMIN_EMAIL'),
            'subject' => __("New Subscription for plan :plan", ['plan' => $order->name]),
            'contents' => view('email.adminSubscriptionOrder')->withOrder($order)->render(),
        ]));

        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => $order->seller->email,
            'name' => $order->seller->name,
            'subject' => __("Your :plan Subscription is processed", ['plan' => $order->name]),
            'contents' => view('email.sellerSubscriptionOrder')->withOrder($order)->render(),
        ]));
    }

    public function adminContactReceived(Request $request){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => env('ADMIN_EMAIL'),
            'subject' => __("Contact inquiry from :name", ['name' => $request->name]),
            'contents' => view('email.adminContactReceived')->withRequest($request)->render(),
            'reply_name' => __(":name ", ['name' => $request->name]),
            'reply_to' => $request->email,
        ]));
    }

    public function adminLeadReceived(User $user, Property $property, Request $request){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => env('ADMIN_EMAIL'),
            'subject' => __("New inquiry from :name ", ['name' => $request->name]),
            'name' => $user->name,
            'contents' => view('email.sellerLeadReceived')->withRequest($request)->withAd($property)->render(),
            'reply_name' => __(":name ", ['name' => $request->name]),
            'reply_to' => $request->email,
        ]));
    }

    public function userLeadResponded(\App\Models\Consult $lead){
        self::email(new Email([
		    'emailClass' => 'DefaultMail',
            'to' => $lead->email,
            'subject' => __("Your inquiry has been responded"),
            'name' =>  __(":name ", ['name' => $lead->name]),
            'contents' => view('email.customerLeadResponded')->withLead($lead)->render(),
            'reply_name' => env('ADMIN_EMAIL'),
            'reply_to' => env('ADMIN_EMAIL'),
        ]));
    }
    /**
     * Dispatch email job
     * @param Email $mail
     */
    public static function email(Email $mail){
        !ENV('EMAIL', false) OR dispatch($mail);
    }
}
