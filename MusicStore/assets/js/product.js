// product class
function product(name, artist, price,
  quantity, discount, image) {
    this.name = name;
    this.artist = artist;
    this.price = price;
    this.quantity = quantity;
    this.discount = discount;
    this.image = image;

  }

/******************************************************************************/
/* *** Example to create object product ***
// store (contains the products)
function store() {
this.products = [
new product("APL", "Apple", "Eat one every…", 12, 90, 0, 2, 0, 1, 2),
new product("AVC", "Avocado", "Guacamole…", 16, 90, 0, 1, 1, 1, 2),
new product("BAN", "Banana", "These are…", 4, 120, 0, 2, 1, 2, 2),
// more products…
new product("WML", "Watermelon", "Nothing…", 4, 90, 4, 4, 0, 1, 1)
];
this.dvaCaption = ["Negligible", "Low", "Average", "Good", "Great" ];
this.dvaRange = ["below 5%", "between 5 and 10%",… "above 40%"];
}
*/
