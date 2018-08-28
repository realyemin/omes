using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QVU.Library.Classes;

namespace QVU.Classes.Objects {
                    public partial class Grup {
                                        public static DataTable LoadToControl() {
            DataTable dtData = (DataTable)DBProcess.SimpleQuery("GRUPLAR",
                "Where SIL='False'",
                "ORDER BY GRPID DESC",
                "GRPID, GRUP_ISMI")["DataTable"];

            return dtData;
        }
    }
}
