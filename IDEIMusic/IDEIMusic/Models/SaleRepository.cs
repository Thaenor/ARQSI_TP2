using IDEIMusic.DAL;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    public class SaleRepository:ISaleRepository
    {
        private LabelContext db = new LabelContext();
        
        public IEnumerable<SaleSummary> GetSaleSummaries()
        {
            IEnumerable<Album> albums = db.Albums.ToList();
            IEnumerable<ItemSale> itemSales = db.ItemSale.ToList();
            IEnumerable<Sale> sales = db.Sales.ToList();

            List<SaleSummary> salesSummary = new List<SaleSummary>();

            foreach(Sale s in sales)
            {
                SaleSummary saleSummary = new SaleSummary();
                saleSummary.ID = s.SaleID;
                saleSummary.PurchaseDate = s.PurchaseDate;

                int totalQuantity = 0;
                float totalIncome = 0;

                foreach(ItemSale i in itemSales)
                {
                    IEnumerable<Album> a = albums.Where(album => album.AlbumID == i.AlbumID);
                    Album albumSelected = a.First();
                    float realAlbumPrice = albumSelected.UnitPrice - (albumSelected.UnitPrice * albumSelected.Discount) / 100;
                    float incomeCalculation = realAlbumPrice * i.Quantity;
                    totalQuantity += i.Quantity;
                    totalIncome += incomeCalculation;
                }
                saleSummary.Quantity = totalQuantity;
                saleSummary.Income = totalIncome;

                salesSummary.Add(saleSummary);
            }

            return salesSummary;
        }
    }
}