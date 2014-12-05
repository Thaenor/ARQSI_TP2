using IDEIMusic.DAL;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Activation;
using System.ServiceModel.Web;
using System.Text;
using System.Web.Helpers;

namespace IDEIMusic
{
    [ServiceContract(Namespace = "")]
    [AspNetCompatibilityRequirements(RequirementsMode = AspNetCompatibilityRequirementsMode.Allowed)]
    public class WebService
    {

        LabelContext db = new LabelContext();

        // To use HTTP GET, add [WebGet] attribute. (Default ResponseFormat is WebMessageFormat.Json)
        // To create an operation that returns XML,
        //     add [WebGet(ResponseFormat=WebMessageFormat.Xml)],
        //     and include the following line in the operation body:
        //         WebOperationContext.Current.OutgoingResponse.ContentType = "text/xml";
        [OperationContract]
        public void DoWork()
        {
            // Add your operation implementation here
            return;
        }

        // Add more operations here and mark them with [OperationContract]

        [OperationContract]
        public string verifyAPI(string inputJSON)
        {
            string j = Json.Decode(inputJSON);

            string result = "fail";
            if (true)
            {
                result = "OK";
            }

            return result;

        }

        [OperationContract]
        public string getAllAbums()
        {
            return Json.Encode(db.Albums.ToList());
        }

        [OperationContract]
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

        [OperationContract]
        public string updateAlbumStock(string inputJSON)
        {
            string j = Json.Decode(inputJSON);

            string result = "fail";
            if(true)
            {
                result = "OK";
            }

            return result;
        }

    }
}
