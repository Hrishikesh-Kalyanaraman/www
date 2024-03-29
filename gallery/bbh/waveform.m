
<< SimulationTools`;

(* Note, the $SimulationPath can be set manually, e.g.
   $SimulationPath = "/work/username/GW150914_28";
   *)
simDirs = ReplaceList[$ScriptCommandLine,
  {___, "--simulations-directory", val_, ___} :> val];

$SimulationPath = Join[simDirs, $SimulationPath];

outDir = Directory[];

sim = "GW150914_28";

ProviderPreferences["InitialData"] = {"TwoPunctures"};
ProviderPreferences["Waveforms"] = {"MultipoleHDF5"};

r0 = 500;
M = ReadADMMass[sim];
Psi422 = Shifted[r0 ReadPsi4[sim, 2, 2, r0], -RadialToTortoise[r0, M]];
omega0 = 0.05;
h22 = StrainFromPsi4[Psi422, omega0];

(* Save the actual data *)
fd = OpenWrite["waveform.csv"];
data = Re[h22]
values = ToListOfData[data];
coords = ToListOfCoordinates[data];
Print["data -> ",data];
For[i=1, i <= Length[data], i = i + 1,
  t = values[[i]];
  x = coords[[i]];
  WriteString[fd, CForm[x], ",", CForm[t], "\n" ]];
Close[fd];

waveformPlot =
 Framed[ListLinePlot[{Re[h22]}, PlotTheme -> "Detailed", PlotRange -> {{0,1000},{-0.5,0.5}},
    LabelStyle -> "Medium",
   FrameLabel -> {"(t-\!\(\*SuperscriptBox[\(r\), \(*\)]\))/M",
     "Re[\!\(\*SuperscriptBox[SubscriptBox[\(h\), \(+\)], \(2, 2\)]\)]"},
   ImageMargins -> 20, Background -> White, ImageSize -> 500,
   AspectRatio -> 1/4, PlotStyle -> Directive[Black, AbsoluteThickness[1]]],
  FrameMargins -> None];

Export[FileNameJoin[{outDir, "waveform.png"}], Magnify[waveformPlot,2]];
