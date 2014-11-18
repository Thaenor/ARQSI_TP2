using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    /// <summary>
    /// Model for User:
    /// UserID: auto-incremented ID
    /// Name: name of user
    /// Type: an ID that defines the type of user
    /// 1- user (view & access to shop cart)
    /// 2- manager (CRUD access to all data)
    /// 3- administrator (view all users)
    /// 
    /// Password: (TODO: encrypt this field) user password
    /// ApiKey: (optional) if type=1 then an API must be generated
    /// PurchaseHistory: A list containing all the albuns the user has purchased
    /// </summary>
    public class User
    {
        public int UserID { get; set; }
        public string Name { get; set; }
        //type: 1-user 2-manager 3-administrator
        public int Type { get; set; }
        public string password { get; set; }
        public string ApiKey { get; set; }

        public virtual ICollection<Album> PurchaseHistory { get; set; }
    }
}