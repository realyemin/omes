using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QVU.Library.Classes;
using System.Collections;

namespace QVU.Classes.QueueLayer {
    public partial class TerminalGrup {

                                                public static DataTable GetGroupOfTerminal(string termID) {
            TerminalGrup termGrup = new TerminalGrup();
            return termGrup.Get("TID=" + termID, "GRPID", "Order By TGID DESC");
            			        }
    }
}
