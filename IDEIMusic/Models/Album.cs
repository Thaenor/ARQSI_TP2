using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    /// <summary>
    /// Model for Album:
    /// AlbumID is auto-increment ID
    /// AlbumName is a mandatory name of album
    /// Price is the price in euros
    /// Discount is a percentage if different than zero it decreseases that % to the price
    /// Description is an optional text (with song titles or other info)
    /// Artist is the name of the Artist/Band that composed the album
    /// Image is the URL path for a image of the album (optional)
    /// </summary>
    public class Album
    {
        public int AlbumID { get; set; }
        public string AlbumName { get; set; }
        public double Price { get; set; }
        //if diferent than zero discount is the % to cut in the price
        public double Discount { get; set; }
        public string Description { get; set; }
        public string Artist { get; set; }
        public string Image { get; set; }

    }
}