using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    public class Sale
    {
        public int SaleID { get; set; }
        public virtual ICollection<ApplicationUser> UserID { get; set; }
        public virtual ICollection<ItemSale> ItemSaleID { get; set; }
        public DateTime PurchaseDate { get; set; }
    }
}