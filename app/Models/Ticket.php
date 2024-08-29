<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\TicketMail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','department_id','complain_id','cat_id','sub_cat_id', 'creator_user_id','product_id','phone','contact_name','email','merchant_name','channel','call_type','employee_id','ticket_owner','assign_user_id','subject','description','status','ticket_sla_time'];

    /**
     * Client name
     *
     * @return void
     */
    public function client_name()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }


    // /**
    //  * Get product name from user
    //  *
    //  * @return void
    //  */
    // public function product_name()
    // {
    //     return $this->belongsTo(Product::class, 'product_id', 'id');
    // }


    /**
     * Get department name from user
     *
     * @return void
     */
    public function department_name()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }



    /**
     * Get Ticket Type from ticket mail
     *
     * @return void
     */
    public function ticket_mail_type()
    {
        return $this->hasOne(TicketMail::class, 'ticket_id', 'id');
    }


    /**
     * Get Assign user from user
     *
     * @return void
     */
    public function assign_user()
    {
        return $this->belongsTo(User::class, 'assign_user_id', 'id');
    }

}
