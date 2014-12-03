using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    /// <summary>
    /// Model for Album:
    /// AlbumID is auto-increment ID
    /// Name is a mandatory name of album
    /// Artist is the name of the Artist/Band that composed the album
    /// StockAmount represents the quantaty of the product currently available
    /// UnitPrice is the price in euros
    /// Discount is a percentage if different than zero it decreseases that % to the price
    /// </summary>
    public class Album
    {
        public int AlbumID { get; set; }
        public string Name { get; set; }
        public string Artist { get; set; }
        public int StockAmount { get; set; }
        public float UnitPrice { get; set; }
        public float Discount { get; set; }
    }
}