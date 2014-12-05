namespace IDEIMusic.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class addedLoginName : DbMigration
    {
        public override void Up()
        {
            AddColumn("dbo.User", "LoginName", c => c.String());
        }
        
        public override void Down()
        {
            DropColumn("dbo.User", "LoginName");
        }
    }
}
