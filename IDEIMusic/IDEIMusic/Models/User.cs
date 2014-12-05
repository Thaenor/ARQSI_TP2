using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    public class User
    {
        public int UserID { get; set; }
        public string LoginName { get; set; }
        public string UserName { get; set; }
        public string UserEmail { get; set; }
        public string UserPassword { get; set; }


    }
}