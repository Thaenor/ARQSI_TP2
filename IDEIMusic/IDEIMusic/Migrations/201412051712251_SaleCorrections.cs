namespace IDEIMusic.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class SaleCorrections : DbMigration
    {
        public override void Up()
        {
            DropForeignKey("dbo.Album", "ItemSale_ItemSaleID", "dbo.ItemSale");
            DropForeignKey("dbo.Sale", "ItemSale_ItemSaleID", "dbo.ItemSale");
            DropIndex("dbo.Album", new[] { "ItemSale_ItemSaleID" });
            DropIndex("dbo.Sale", new[] { "ItemSale_ItemSaleID" });
            AddColumn("dbo.ItemSale", "AlbumID", c => c.Int(nullable: false));
            AddColumn("dbo.ItemSale", "Sale_SaleID", c => c.Int());
            CreateIndex("dbo.ItemSale", "Sale_SaleID");
            AddForeignKey("dbo.ItemSale", "Sale_SaleID", "dbo.Sale", "SaleID");
            DropColumn("dbo.Album", "ItemSale_ItemSaleID");
            DropColumn("dbo.Sale", "ItemSale_ItemSaleID");
        }
        
        public override void Down()
        {
            AddColumn("dbo.Sale", "ItemSale_ItemSaleID", c => c.Int());
            AddColumn("dbo.Album", "ItemSale_ItemSaleID", c => c.Int());
            DropForeignKey("dbo.ItemSale", "Sale_SaleID", "dbo.Sale");
            DropIndex("dbo.ItemSale", new[] { "Sale_SaleID" });
            DropColumn("dbo.ItemSale", "Sale_SaleID");
            DropColumn("dbo.ItemSale", "AlbumID");
            CreateIndex("dbo.Sale", "ItemSale_ItemSaleID");
            CreateIndex("dbo.Album", "ItemSale_ItemSaleID");
            AddForeignKey("dbo.Sale", "ItemSale_ItemSaleID", "dbo.ItemSale", "ItemSaleID");
            AddForeignKey("dbo.Album", "ItemSale_ItemSaleID", "dbo.ItemSale", "ItemSaleID");
        }
    }
}
