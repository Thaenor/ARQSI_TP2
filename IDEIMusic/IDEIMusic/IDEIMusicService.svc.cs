using IDEIMusic.DAL;
using IDEIMusic.Models;
using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.Text;
using System.Web.Helpers;
using System.Web.Script.Serialization;

namespace IDEIMusic
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the class name "IDEIMusicService" in code, svc and config file together.
    // NOTE: In order to launch WCF Test Client for testing this service, please select IDEIMusicService.svc or IDEIMusicService.svc.cs at the Solution Explorer and start debugging.
    public class IDEIMusicService : IIDEIMusicService
    {
        LabelContext db = new LabelContext();
        public void DoWork()
        {
        }

        public string Test()
        {
            return "it works!";
        }

        public string verifyAPI(string adminLojaID, string api_key)
        {

            Store storeSelected = db.Stores.Where(store => store.UserEmail == adminLojaID).First();

            if (storeSelected.store_api_key.ToString() == api_key)
                return "true";

            return "false";
        }
        
        public string getAPI_KEY(string adminLojaID)
        {
            Store storeAdmin = db.Stores.Where(adminId => adminId.UserEmail == adminLojaID).First();

            if (storeAdmin != null)
            {
                return storeAdmin.store_api_key;
            }

            return "Not registered. Please consider registering at IDEIMusic website first at http://wvm024.dei.isep.ipp.pt/ideimusic/Stores/Create";
        }

        public string getAllAbums(string api_key)
        {

            Store storeAdmin = db.Stores.Where(adminId => adminId.store_api_key == api_key).First();
            if (storeAdmin != null)
            {
                return Json.Encode(db.Albums.ToList());
            }

            return "Incorrect API_KEY or not registed at IDEIMusic. Please consider registering at IDEIMusic website first at http://wvm024.dei.isep.ipp.pt/ideimusic/Stores/Create";
        }

        public string RegisterSale(string inputJSON)
        {
            string j = Json.Decode(inputJSON);

            string result = "Fail";
            if (true)
            {
                result = "OK";
            }

            return result;

        }

        public string updateAlbumStock(string api_key, int albumID, int quantity)
        {
            Store storeAdmin = db.Stores.Where(adminId => adminId.store_api_key == api_key).First();
            Album albumToUpdate = db.Albums.Where(idAlbum => idAlbum.AlbumID == albumID).First();

            if (storeAdmin != null && albumToUpdate != null)
            {
                albumToUpdate.StockAmount -= quantity;

                db.Entry(albumToUpdate).State = System.Data.Entity.EntityState.Modified;

                db.SaveChanges();

                return "updated";
            }

            return "fail";
        }
    }
}
