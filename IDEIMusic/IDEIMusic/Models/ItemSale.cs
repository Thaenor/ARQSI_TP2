using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    public class ItemSale
    {
        public ICollection<Sale> SaleID { get; set; }
        public ICollection<Album> AlbumID { get; set; }
        public int Quantity { get; set; }
    }
}