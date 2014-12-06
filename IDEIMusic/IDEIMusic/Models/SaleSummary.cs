using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    /// <summary>
    /// Return a Sale Summary for listing purposes
    /// </summary>
    public class SaleSummary
    {
        public int ID { get; set; }
        public DateTime PurchaseDate { get; set; }
        public int Quantity { get; set; }
        public float Income { get; set; }
    }
}