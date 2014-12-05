using IDEIMusic.DAL;
using IDEIMusic.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace IDEIMusic.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }

        public ActionResult Login()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Login(User u)
        {
                using (LabelContext db = new LabelContext())
                {
                    var user = db.Users.Where(a => a.LoginName.Equals(u.UserEmail) && a.UserPassword.Equals(u.UserPassword)).FirstOrDefault();
                    
                    if(user == null)
                    {
                       user = db.Users.Where(a => a.UserEmail.Equals(u.UserEmail) && a.UserPassword.Equals(u.UserPassword)).FirstOrDefault();
                    }

                    if (user != null)
                    {
                        if (user is Administrator)
                        {
                            Session["Role"] = "Administrator";
                        }
                        else if (user is Manager)
                        {
                            Session["Role"] = "Manager";
                        }
                        else if (user is Store)
                        {
                            Session["Role"] = "Store";
                            Store a = (Store)user;
                            Session["API_Key"] = a.store_api_key.ToString();
                        }
                        else
                        {
                            Session["Role"] = "ERROR";
                        }

                        Session["ID"] = user.UserID.ToString();
                        Session["LoginName"] = user.LoginName.ToString();
                        Session["UserName"] = user.UserName.ToString();
                        Session["Email"] = user.UserEmail;
                        return View("Index");

                    }
                }
            
            return View("Login");
        }

        public ActionResult Logout()
        {
            Session.RemoveAll();
            Session.Clear();
            Session.Abandon();
            return RedirectToAction("Login");
        }
    }
}