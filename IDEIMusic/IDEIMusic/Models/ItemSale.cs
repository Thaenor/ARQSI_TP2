using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    /// <summary>
    /// ItemSale is the intermediary table between Sale and Album, it's required since they have a many to many relationship.
    /// SaleID is the primary and foreign key for the Sale table
    /// AlbumID is the primary and foreign key for the Album table
    /// Quantity is the integer of how much of a specific product was purchased
    /// </summary>
    public class ItemSale
    {
        public ICollection<Sale> SaleID { get; set; }
        public ICollection<Album> AlbumID { get; set; }
        public int Quantity { get; set; }
    }
}