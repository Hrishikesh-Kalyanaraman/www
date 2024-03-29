<?php $title='GRHydro-MHD: A public general relativistic magneto-hydrodynamics code';
include_once($_SERVER['DOCUMENT_ROOT'].'/global/header.php');?>

<b><font color="red">THIS IS WORK IN PROGRESS</font></b>

<ul>
<li>Philipp M&ouml;sta</li>
<li>Bruno C. Mundim</li>
<li>Joshua A. Faber</li>
<li>Roland Haas</li>
<li>Scott C. Noble</li>
<li>Tanja Bode</li>
<li>Frank L&ouml;ffler</li>
<li>Christian D. Ott</li>
<li>Christian Reisswig</li>
<li>Erik Schnetter</li>
</ul>
<p>
We present the new general-relativistic magnetohydrodynamics (GRMHD)
capabilities of the Einstein Toolkit, an open-source community-driven
numerical relativity and computational relativistic astrophysics
code. The GRMHD extension of the Toolkit builds upon previous releases
and implements the evolution of relativistic magnetised fluids in the
ideal MHD limit in fully dynamical spacetimes using the same
shock-capturing techniques previously applied to hydrodynamical
evolution.  In order to maintain the divergence-free character of the
magnetic field, the code implements both hyperbolic divergence
cleaning and constrained transport schemes.  We present test results
for a number of MHD tests in Minkowski and curved spacetimes.
Minkowski tests include aligned and oblique planar shocks, cylindrical
explosions, magnetic rotors, Alfv\'en waves and advected loops, as
well as a set of tests designed to study the response of the
divergence cleaning scheme to numerically generated monopoles.  We
study the code's performance in curved spacetimes with spherical
accretion onto a black hole on a fixed background spacetime and in
fully dynamical spacetimes by evolutions of a magnetised polytropic
neutron star and of the collapse of a magnetised stellar core.  Our
results agree well with exact solutions where these are
available and we demonstrate convergence.  All code and input files
used to generate the results are available on
<a href="http://einsteintoolkit.org">http://einsteintoolkit.org</a>.
This makes our work fully
reproducible and provides new users with an introduction to
applications of the code.
</p>

<ul>
<li>doi: <a href=""></a></li>
<li>arXiv: <a href="http://arxiv.org/abs/1304.5544">1304.5544 [gr-qc]</a></li>
</ul>

<h3>Materials</h3>

<h4>Monopole Tests</h4>
 <table>
  <tr><th>parfiles </th><td>
  <a href="par/monopole/monopole-altgauss-1.par">monopole-altgauss-1.par</a>
  <a href="par/monopole/monopole-altgauss-10.par">monopole-altgauss-10.par</a>
  <a href="par/monopole/monopole-altgauss-noclean.par">monopole-altgauss-noclean.par</a>
  <a href="par/monopole/monopole-altgauss.par">monopole-altgauss.par</a>
  <a href="par/monopole/monopole-gauss-noclean.par">monopole-gauss-noclean.par</a>
  <a href="par/monopole/monopole-gauss.par">monopole-gauss.par</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>16 cores, 200 min</td></tr>
  <tr><th>memory   </th><td>500 MB per core</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Planar MHD Shocktubes</h4>
 <table>
  <tr><th>parfiles  </th><td>
  <a href="par/shocktubes/balsara1_1d.par">balsara1_1d.par</a>
  <a href="par/shocktubes/balsara1_2d.par">balsara1_2d.par</a>
  <a href="par/shocktubes/balsara1_2d_low.par">balsara1_2d_low.par</a>
  <a href="par/shocktubes/balsara2_1d.par">balsara2_1d.par</a>
  <a href="par/shocktubes/balsara2_2d.par">balsara2_2d.par</a>
  <a href="par/shocktubes/balsara3_1d.par">balsara3_1d.par</a>
  <a href="par/shocktubes/balsara3_2d.par">balsara3_2d.par</a>
  <a href="par/shocktubes/balsara4_1d.par">balsara4_1d.par</a>
  <a href="par/shocktubes/balsara4_2d.par">balsara4_2d.par</a>
  <a href="par/shocktubes/balsara5_1d.par">balsara5_1d.par</a>
  <a href="par/shocktubes/balsara5_2d.par">balsara5_2d.par</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>1D: 2 cores, 2D: 16 cores, 240 min</td></tr>
  <tr><th>memory   </th><td>1D: 120 MB per core, 2D: 520 MB per core</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Cylindrical Shocks</h4>
 <table>
  <tr><th>parfile generator </th><td>
  <a href="par/cylexp/cylexp_tvd_mc2_hlle.rpar">cylexp_tvd_mc2_hlle.rpar</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>4 cores, 160 min</td></tr>
  <tr><th>memory   </th><td>600 MB per core</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Magnetic Rotor</h4>
 <table>
  <tr><th>parfile generator </th><td>
  <a href="par/rotor/rotor.rpar">rotor.rpar</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>4 cores, 290 min</td></tr>
  <tr><th>memory   </th><td>800 MB per core</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Alfvén Wave</h4>
 <table>
  <tr><th>parfiles  </th><td>
  <a href="par/alfvenwave/alfvenwave1d_128.par">alfvenwave1d_128.par</a>
  <a href="par/alfvenwave/alfvenwave1d_16.par">alfvenwave1d_16.par</a>
  <a href="par/alfvenwave/alfvenwave1d_32.par">alfvenwave1d_32.par</a>
  <a href="par/alfvenwave/alfvenwave1d_64.par">alfvenwave1d_64.par</a>
  <a href="par/alfvenwave/alfvenwave2d_160_120.par">alfvenwave2d_160_120.par</a>
  <a href="par/alfvenwave/alfvenwave2d_20_15.par">alfvenwave2d_20_15.par</a>
  <a href="par/alfvenwave/alfvenwave2d_40_30.par">alfvenwave2d_40_30.par</a>
  <a href="par/alfvenwave/alfvenwave2d_80_60.par">alfvenwave2d_80_60.par</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>1D: 4 cores, 60min, 2D: 4 cores, 220 min</td></tr>
  <tr><th>memory   </th><td>1D: 12 MB per core, 2D: 60MB per core</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Loop advection</h4>
 <table>
  <tr><th>parfiles  </th><td>
  <a href="par/advloop/advectedloop2D.par">par/advloop/advectedloop2D.par</a>
  <a href="par/advloop/advectedloop2D_hi.par">par/advloop/advectedloop2D_hi.par</a>
  <a href="par/advloop/advectedloop2D_vz.par">par/advloop/advectedloop2D_vz.par</a>
  <a href="par/advloop/advectedloop2D_vz_hi.par">par/advloop/advectedloop2D_vz_hi.par</a>
  <a href="par/advloop/advectedloop3D.par">par/advloop/advectedloop3D.par</a>
  <a href="par/advloop/advectedloop3D_vz.par">par/advloop/advectedloop3D_vz.par</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>36 cores, 250 min</td></tr>
  <tr><th>memory   </th><td>100 MB per core</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Bondi Inflow</h4>
 <table>
  <tr><th>parfile generator  </th><td><a href="par/bondi/BondiFlowBase.rpar">BondiFlowBase.rpar</a></td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>48 cores, 420 min</td></tr>
  <tr><th>memory   </th><td>350 MB per core</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Magnetized TOV</h4>
 <table>
  <tr><th>parfiles </th><td>
  <a href="par/tov/tov16m3.par">par/tov/tov16m3.par</a>
  <a href="par/tov/tov4m3.par">par/tov/tov4m3.par</a>
  <a href="par/tov/tov8m3.par">par/tov/tov8m3.par</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="https://svn.einsteintoolkit.org/manifest/branches/ET_2013_05/einsteintoolkit.th">Einstein Toolkit 2013_05 release</a></td></tr>
  <tr><th>CPU time </th><td>x SU</td></tr>
  <tr><th>memory   </th><td>x GB</td></tr>
  <tr><th>Notes    </th><td>...</td></tr>
 </table>
<h4>Rotating Collapse</h4>
 <table>
  <tr><th>parfiles </th><td>
  <a href="par/collapse/A3_oct.par">A3_oct.par</a>
  <a href="par/collapse/A3_oct_64.par">A3_oct_64.par</a>
  <a href="par/collapse/A3_oct_80.par">A3_oct_80.par</a>
  </td></tr>
  <tr><th>thornlist</th><td><a href="einsteintoolkit_plus_zelmani.th">Einstein Toolkit 2013_05 release + selected Zelmani</a></td></tr>
  <tr><th>Initial data</th><td>
  <a href="http://www.tapir.caltech.edu/~rhaas/ET/2013_MHD/collapse/ID_A3_oct.h5.xz">ID_A3_oct.h5.xz (221Mb)</a>
  <a href="http://www.tapir.caltech.edu/~rhaas/ET/2013_MHD/collapse/ID_A3_oct_64.h5.xz">ID_A3_oct_64.h5.xz (388Mb)</a>
  <a href="http://www.tapir.caltech.edu/~rhaas/ET/2013_MHD/collapse/ID_A3_oct_80.h5.xz">ID_A3_oct_80.h5.xz (747Mb)</a>
  </td></tr>
  <tr><th>CPU time </th><td>x SU</td></tr>
  <tr><th>memory   </th><td>x GB</td></tr>
  <tr><th>Notes    </th><td>ID generated via RNSID.</td></tr>
 </table>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/global/footer.php');?>
