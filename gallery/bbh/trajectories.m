
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

trajs = ReadBHTrajectories[sim];
relTrajs = trajs[[1]] - trajs[[2]];

(* Save the trajectories data in a file. *)
fd = OpenWrite["trajectories.csv"];
For[i=1, i <= Length[relTrajs], i = i + 1,
  t = relTrajs[[i]];
  WriteString[fd, CForm[t[[1]]], ",", CForm[t[[2]]], "\n" ]];
Close[fd];

trajPlot =
  Framed[ListLinePlot[relTrajs,
    PlotTheme -> "Detailed",
    AspectRatio -> Automatic, LabelStyle -> "Medium",
    FrameLabel -> {"(\!\(\*SubscriptBox[\(x\), \(1\)]\)-\!\(\*SubscriptBox[\(x\
      \), \(2\)]\))/M",
      "(\!\(\*SubscriptBox[\(y\), \(1\)]\)-\!\(\*SubscriptBox[\(y\), \
        \(2\)]\))/M"}, ImageMargins -> 20, Background -> White, ImageSize -> 200,
    PlotRange -> {{-1, 1}, {-1, 1}} 12,
    PlotStyle -> Directive[Black, AbsoluteThickness[1]]], FrameMargins -> None];

Export[FileNameJoin[{outDir, "trajectories.png"}], Magnify[trajPlot,2]];
