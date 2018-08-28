// Type: QLU.Classes.Datas
// Assembly: QLU, Version=1.1.0.0, Culture=neutral, PublicKeyToken=null
// MVID: 5FBC9314-0845-40D3-B639-F723476E848F
// Assembly location: C:\OMES .NET\Açılacak\QLU\program files\OMES Elektronik\QLU\QLU.exe

using System;

namespace QLU.Classes
{
  public class Datas : IDisposable
  {
    public string VezneNo { get; set; }

    public string BiletNo { get; set; }

    public Ways OkYonu { get; set; }

    public CommandDataTypes KomutData { get; set; }

    public string UstBaslik { get; set; }

    public string AltBaslik { get; set; }

    public Results Sonuclar { get; set; }

    public ResultValues SonucDegeri { get; set; }

    public void Dispose()
    {
      GC.Collect();
    }
  }
}
