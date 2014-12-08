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

        public string verifyAPI(string inputJSON)
        {

            JObject json_object = JObject.Parse(inputJSON);

            var user = json_object["UserID"].ToString();
            var API_Key = json_object["API_KEY"].ToString();

            Store storeSelected = db.Stores.Where(store => store.UserEmail == user).First();

            if (storeSelected.store_api_key.ToString() == API_Key)
                return "True";

            return "False";
        }

        public string firstContact(string inputJSON)
        {
            var j = Json.Decode(inputJSON);

            string userName = j["UserEmail"];
            var user = db.Users.Where(a => a.UserEmail.Equals(userName)).FirstOrDefault();

            string result = "fail";

            if (user != null)
            {
                if (user is Store)
                {
                    Store a = (Store)user;
                    result = a.store_api_key.ToString();
                }
            }

            return result;
        }

        public string getAllAbums()
        {
            return Json.Encode(db.Albums.ToList());
        }

        public string RegisterSale(string inputJSON)
        {
            string j = Json.Decode(inputJSON);

            string result = "fail";
            if (true)
            {
                result = "OK";
            }

            return result;

        }

        public string updateAlbumStock(string inputJSON)
        {
            string j = Json.Decode(inputJSON);

            string result = "fail";
            if (true)
            {
                result = "OK";
            }

            return result;
        }
    }
}
