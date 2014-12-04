using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    /// <summary>
    /// The table for Sale record information on sold Albums.
    /// SaleID is the primary key and auto-incremented ID.
    /// UserID is the foreign key indicating the buyer
    /// PurchaseDate is the date of purchase as name implies.
    /// </summary>
    public class Sale
    {
        public int SaleID { get; set; }
        public DateTime PurchaseDate { get; set; }
    }
}