<?php namespace App\Repositories;

use App\Repositories\Role;

use App\User;
use App\Payment;
use App\Referal;
use App\Registered_awaiting_approval;

class Notification
{
	private $unconfirmed_members = array();
	private $unapproved_members = array();
	private $upgrade_payments = array();

	public function get($user)
	{
		$role = new Role;
		$user_roles = $this->user_roles($user);
		$this->notifications['user_roles'] = $user_roles;

		if($role->registeration($user)) {
			$this->unconfirmed_members = $this->unconfirmed_users();
			$this->unapproved_members = $this->unapproved_users();
			$this->notifications['unconfirmed'] = $this->unconfirmed_members;
			$this->notifications['unapproved'] = $this->unapproved_members;
		}

		if($role->financial($user)) {
			$this->upgrade_payments = $this->financial_member_payments();
			$this->notifications['upgrade_payments'] = $this->upgrade_payments;
		}

		$this->notifications['referal_requests'] = $user->referal_recepients;
		$this->total_notifications = count($this->unconfirmed_members) + count($this->unapproved_members) + count($this->upgrade_payments) + count($user->referal_recepients);
		$this->notifications['total'] = $this->total_notifications;

		return $this->notifications;
	}

	public function unconfirmed_users()
	{
		//Get unconfirmed users
		$users = User::where('confirmed', '0')->get();
		return $users;
	}

	public function unapproved_users()
	{
		//Get unconfirmed users
		$awaitingApproval = new Registered_awaiting_approval;
		$users = $awaitingApproval->all();
		//$users = User::where('confirmed', '1')->where('approved', '0')->get();

		return $users;
	}

	public function financial_member_payments()
	{
		//Get Members that have paid to become financial members
		$payments = Payment::where('due_id', '1')->where('confirmed', '0')->get();
		return $payments;
	}

	public function referal_requests()
	{
		//Get Referal Request
		$user_id = Auth::user()->id;
		$referees = Referal::where('referee_id', $user_id)->get();
		return $referees;
	}

	private function user_roles($user)
	{
		$roles = array();
		$user_roles = $user->user_roles;
		if(!empty($user_roles)) {
			foreach($user_roles as $role) {
				$roles[] = $role['role_id'];
			}
		}
		return $roles;
	}
}