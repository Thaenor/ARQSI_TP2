using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    /// <summary>
    /// Model for Shopping Cart
    /// ShoppingCartID: auto incremented ID
    /// AssocUserID: is the ID for the associated user
    /// Totalprice: is the sum of all the albuns in the cart (discounts already applied)
    /// AlbumsInCart: is a list containing all the albums inside the cart
    /// This is a navigation property. Navigation properties hold other entities that are related to this entity.
    /// Navigation properties are typically defined as virtual so that they can take advantage of certain Entity Framework functionality such as lazy loading. 
    /// </summary>
    public class ShoppingCart
    {
        public int ShoppingCartID { get; set; }
        public string AssocUserID { get; set; }
        public double Totalprice { get; set; }

        public virtual ICollection<Album> AlbumsInCart { get; set; }
    }
}