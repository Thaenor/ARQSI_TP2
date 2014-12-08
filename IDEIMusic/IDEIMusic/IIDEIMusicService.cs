using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.Text;

namespace IDEIMusic
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the interface name "IIDEIMusicService" in both code and config file together.
    [ServiceContract]
    public interface IIDEIMusicService
    {
        [OperationContract]
        void DoWork();
        [OperationContract]
        string Test();
        [OperationContract]
        string verifyAPI(string adminLojaID, string api_key);
        [OperationContract]
        string getAPI_KEY(string adminLojaID);
        [OperationContract]
        string getAllAbums(string api_key);
        [OperationContract]
        string RegisterSale(string inputJSON);
        [OperationContract]
        string updateAlbumStock(string api_key, int albumID, int quantity);
    }
}
