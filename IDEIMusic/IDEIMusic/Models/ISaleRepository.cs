using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace IDEIMusic.Models
{
    public interface ISaleRepository
    {
        IEnumerable<SaleSummary> GetSaleSummaries();
        IEnumerable<SaleSummary> GetSaleSummariesBySales();
        IEnumerable<SaleSummary> GetSaleSummariesByIncome();
    }
}