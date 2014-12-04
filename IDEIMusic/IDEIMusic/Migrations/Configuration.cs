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
            context.SaveChanges();
        }
    }
}
