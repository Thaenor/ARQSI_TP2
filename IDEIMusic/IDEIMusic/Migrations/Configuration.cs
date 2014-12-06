namespace IDEIMusic.Migrations
{
    using IDEIMusic.Models;
    using System;
    using System.Collections.Generic;
    using System.Data.Entity;
    using System.Data.Entity.Migrations;
    using System.Linq;

    internal sealed class Configuration : DbMigrationsConfiguration<IDEIMusic.DAL.LabelContext>
    {
        public Configuration()
        {
            AutomaticMigrationsEnabled = false;
        }

        protected override void Seed(IDEIMusic.DAL.LabelContext context)
        {
            //  This method will be called after migrating to the latest version.

            //  You can use the DbSet<T>.AddOrUpdate() helper extension method 
            //  to avoid creating duplicate seed data. E.g.
            //
            //    context.People.AddOrUpdate(
            //      p => p.FullName,
            //      new Person { FullName = "Andrew Peters" },
            //      new Person { FullName = "Brice Lambson" },
            //      new Person { FullName = "Rowan Miller" }
            //    );
            //
            var albums = new List<Album>
            {
                new Album { Name="THE ENDLESS RIVER", Artist="PINK FLOYD", StockAmount=5, UnitPrice=20, Discount=10 },
                new Album { Name="SONIC HIGHWAYS", Artist="FOO FIGHTERS", StockAmount=6, UnitPrice=30, Discount=20 },
                new Album { Name="X", Artist="ED SHEERAN", StockAmount=7, UnitPrice=20, Discount=30 },
                new Album { Name="IN THE LONELY HOUR", Artist="SAM SMITH", StockAmount=8, UnitPrice=10, Discount=10 },
                new Album { Name="FOREVER", Artist="QUEEN", StockAmount=9, UnitPrice=25, Discount=0 },
                new Album { Name="1989", Artist="TAYLOR SWIFT", StockAmount=10, UnitPrice=10, Discount=10 },
                new Album { Name="ONLY HUMAN", Artist="CHERYL", StockAmount=10, UnitPrice=20, Discount=15 },
                new Album { Name="LOVE IN VENICE", Artist="ANDRE RIEU", StockAmount=11, UnitPrice=20, Discount=10 }
            };
            albums.ForEach(s => context.Albums.AddOrUpdate(p => p.Name, s));

            var salesItens = new List<ItemSale>
            {
                new ItemSale { AlbumID = 1,Quantity = 6},
                new ItemSale { AlbumID = 2,Quantity = 2},
                new ItemSale { AlbumID = 4,Quantity = 1},
                new ItemSale { AlbumID = 6,Quantity = 2}
            };
            salesItens.ForEach(s => context.ItemSale.AddOrUpdate(p => p.AlbumID, s));

            var sales = new List<Sale>
            {
                new Sale { ItemSaleID = salesItens, PurchaseDate = DateTime.Now}
            };
            sales.ForEach(s => context.Sales.AddOrUpdate(p => p.SaleID, s));

            
            context.SaveChanges();
        }
    }
}
