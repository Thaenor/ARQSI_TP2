namespace IDEIMusic.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class INIT : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Album",
                c => new
                    {
                        AlbumID = c.Int(nullable: false, identity: true),
                        Name = c.String(),
                        Artist = c.String(),
                        StockAmount = c.Int(nullable: false),
                        UnitPrice = c.Single(nullable: false),
                        Discount = c.Single(nullable: false),
                        ItemSale_ItemSaleID = c.Int(),
                    })
                .PrimaryKey(t => t.AlbumID)
                .ForeignKey("dbo.ItemSale", t => t.ItemSale_ItemSaleID)
                .Index(t => t.ItemSale_ItemSaleID);
            
            CreateTable(
                "dbo.ItemSale",
                c => new
                    {
                        ItemSaleID = c.Int(nullable: false, identity: true),
                        Quantity = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ItemSaleID);
            
            CreateTable(
                "dbo.Sale",
                c => new
                    {
                        SaleID = c.Int(nullable: false, identity: true),
                        PurchaseDate = c.DateTime(nullable: false),
                        ItemSale_ItemSaleID = c.Int(),
                    })
                .PrimaryKey(t => t.SaleID)
                .ForeignKey("dbo.ItemSale", t => t.ItemSale_ItemSaleID)
                .Index(t => t.ItemSale_ItemSaleID);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.Sale", "ItemSale_ItemSaleID", "dbo.ItemSale");
            DropForeignKey("dbo.Album", "ItemSale_ItemSaleID", "dbo.ItemSale");
            DropIndex("dbo.Sale", new[] { "ItemSale_ItemSaleID" });
            DropIndex("dbo.Album", new[] { "ItemSale_ItemSaleID" });
            DropTable("dbo.Sale");
            DropTable("dbo.ItemSale");
            DropTable("dbo.Album");
        }
    }
}
