using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    public interface ISaleRepository
    {
        IEnumerable<SaleSummary> GetSaleSummaries();
    }
}