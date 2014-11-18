namespace IDEIMusic.Migrations
{
    using System;
    using System.Collections.Generic;
    using System.Data.Entity.Migrations;
    using System.Linq;
    using IDEIMusic.Models;

    internal sealed class Configuration : DbMigrationsConfiguration<IDEIMusic.DAL.MusicContext>
    {
        public Configuration()
        {
            AutomaticMigrationsEnabled = false;
        }

        /// <summary>
        /// this method populates the database with static data
        /// </summary>
        /// <param name="context"></param>
        protected override void Seed(IDEIMusic.DAL.MusicContext context)
        {
            //  This method will be called after migrating to the latest version.
            // The first parameter passed to the AddOrUpdate method specifies the property to use to check if a row already exists. 

            var albums = new List<Album>
            {
                new Album { AlbumName = "THE ENDLESS RIVER",   Price = 25, 
                    Discount = 0, Description="(RHINO)", Artist="PINK FLOYD", Image="" },
                new Album { AlbumName = "SONIC HIGHWAYS",   Price = 26, 
                    Discount = 5, Description="(RCA)", Artist="FOO FIGHTERS", Image="" },
                new Album { AlbumName = "X",   Price = 30, 
                    Discount = 25, Description="(ASYLUM)", Artist="ED SHEERAN", Image="" },
                new Album { AlbumName = "IN THE LONELY HOUR",   Price = 26, 
                    Discount = 0, Description="(CAPITOL)", Artist="SAM SMITH", Image="" },
                new Album { AlbumName = "FOREVER",   Price = 27, 
                    Discount = 15, Description="(VIRGIN)", Artist="QUEEN", Image="" },
                new Album { AlbumName = "1989",   Price = 35, 
                    Discount = 0, Description="(EMI)", Artist="TAYLOR SWIFT", Image="" },
                new Album { AlbumName = "ONLY HUMAN",   Price = 25, 
                    Discount = 10, Description="(POLYDOR)", Artist="CHERYL", Image="" },
                new Album { AlbumName = "LOVE IN VENICE",   Price = 20, 
                    Discount = 0, Description="(DECCA)", Artist="ANDRE RIEU", Image="" },
            };
            albums.ForEach(s => context.Albums.AddOrUpdate(p => p.AlbumName, s));
            context.SaveChanges();


            var users = new List<User>
            {
                new User { Name="Manager", Type=2, password="root" },
                new User { Name="Admin", Type=3, password="network" },
                new User { Name="John", Type=1, password="123", ApiKey="7K6h1w2133"},
                new User { Name="Jane", Type=1, password="password", ApiKey="24945FRqK8"},
                new User { Name="Smith", Type=1, password="passw0rd", ApiKey="1h999OW5E3"}
            };
            users.ForEach(s => context.Users.AddOrUpdate(p => p.Name, s));
            context.SaveChanges();


        }
    }
}
