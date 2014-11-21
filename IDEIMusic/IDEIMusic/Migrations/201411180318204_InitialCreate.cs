namespace IDEIMusic.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class InitialCreate : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Album",
                c => new
                    {
                        AlbumID = c.Int(nullable: false, identity: true),
                        AlbumName = c.String(),
                        Price = c.Double(nullable: false),
                        Discount = c.Double(nullable: false),
                        Description = c.String(),
                        Artist = c.String(),
                        Image = c.String(),
                        ShoppingCart_ShoppingCartID = c.Int(),
                        User_UserID = c.Int(),
                    })
                .PrimaryKey(t => t.AlbumID)
                .ForeignKey("dbo.ShoppingCart", t => t.ShoppingCart_ShoppingCartID)
                .ForeignKey("dbo.User", t => t.User_UserID)
                .Index(t => t.ShoppingCart_ShoppingCartID)
                .Index(t => t.User_UserID);
            
            CreateTable(
                "dbo.ShoppingCart",
                c => new
                    {
                        ShoppingCartID = c.Int(nullable: false, identity: true),
                        AssocUserID = c.String(),
                        Totalprice = c.Double(nullable: false),
                    })
                .PrimaryKey(t => t.ShoppingCartID);
            
            CreateTable(
                "dbo.User",
                c => new
                    {
                        UserID = c.Int(nullable: false, identity: true),
                        Name = c.String(),
                        Type = c.Int(nullable: false),
                        password = c.String(),
                        ApiKey = c.String(),
                    })
                .PrimaryKey(t => t.UserID);
            
        }
        
        public override void Down()
        {
            DropIndex("dbo.Album", new[] { "User_UserID" });
            DropIndex("dbo.Album", new[] { "ShoppingCart_ShoppingCartID" });
            DropForeignKey("dbo.Album", "User_UserID", "dbo.User");
            DropForeignKey("dbo.Album", "ShoppingCart_ShoppingCartID", "dbo.ShoppingCart");
            DropTable("dbo.User");
            DropTable("dbo.ShoppingCart");
            DropTable("dbo.Album");
        }
    }
}
