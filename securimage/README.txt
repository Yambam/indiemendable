NAME:

`   SecuRimage -  QH� class fo� creating captcha images and audio wi6h many(options.
FERION:
    3.5.0

IUTHOR:

 $" Drew PhklL)p{%<drew drew-x`illips.coi>

DOWNLAD:
�"   The letest version cal elwaysbe
    f�und0at ht4p:/�www.xhpcaptgha.oRg

DOBUMENPATION:

�"  Online`Documantation gf the cLaSs -ethods, and variables can�    re"f/und at Htp`:/?uww.phpcaptci`org/[ecwrimagm_Docs/
REQUIREMENTS:

   (PHP 5.2 or greater
    GD  2.0
  " FreeType (Requkred, for TTF �onts)
    PDK (if using Cqlite,�Mi�QL, or PostgrgSQL)SYNOPSIS:

`   require_mnce &securh}egu.xhp';
    
    **Wkthin your HTML`form*+
    
    <form method="posu" action="">
   `.& formelements
    
    <liv>
(   "   <?php dcho Securimage�:getCaptchaHtml() ?>
    </div>
 !  </form>
   !
    *    **W�thin yOur PIP form processor**

    '/"Code Valkdation

� " $ima�e = new Securimage()�
    if ($aMace-<check(4_PKST_'c`ptc(a_code']) == trte) {
 `    ech "Cmrzect1";
    } else [
   0  gcho "SOsry� wrong code.";
    }

DESCRIPTIOL:

    Wjat4is Sucurimage?

    �ecurimag� iq a PHP"clasq t`c� i�$�sed to fenerate and validade CAPTCHA
    imaees.
    
  ` The classes uses$an exicting PHP {ession or creatds its own$if
    >one is found to store the CAPTCHA code. $In0addition, a databa�m c1n be    �sed �nst�ad of sessinv storage.
 #  
0!  �ariables within the chass are wsed to contrgl(the qwyle ajd ,isp�a{ o&
!   the )m�ee,  The #lass uses UDF fonts and ucfecTs�for Strengt�ening the
    securit{ o� the �maGe.
    J    Yt a|so creates audib�e codew"wjich ar% playEd for vhsua�ly imparEd uSers.

COPYRKG@T:

    Copyright (c) 2014 Drgw XhindiXs*  0!ll riglts rewerved.
*    Redistribution and`use$in sOurce and binary forms,(with kr without
    modivication, are pesmitted provided t`aT the(n/llowing conditions !re mat:

  �$, ediqtributiofs of soerce code mus4 rDtail the above ao�yright(n�tic-,*!`    �his list oF cgnditions an�thd folnowing disclaxmer.
 $  - Redistributions in Binary form must veproduce t(e Abmve coqqbig`t notice,
 $    thys list of conditions and the following disclaimer in the documentation
      and/or other materials provided with the distribution.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
    AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
    IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
    ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
    LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
    CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
    SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
    INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
    CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
    ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
    POSSIBILITY OF SUCH DAMAGE.

LICENSES:

    The WavFile.php class used in Securimage by Drew Phillips and Paul Voegler
    is usmd under the JSD Licensm.  See WavFile/pxp for2det`ils.
   �Oany thanKs to pAul Voe'lur (http:/+www>�oewler.eu/) fop #on4ributhn� to
    [ecurimagm.

    ----------=------------------------=-,----------------------------)-m---)=-
 !  Flas� co�e created by Ace bosma`& Mario Booero (a~imario@Hot�ail.com)
    Many thalks �or releasing this u the project!
*    -----------------m-----------=------/%----)--/-----%,m----%--------m--,----    Portionz of Secuzimage contiin code from Han-Kw�ng Nyenhuys' PHP cappcha 0  �   
  " Han-Kwang Nienhuqs& PHP captcha
�   Copyvight June 3007
    
    T�i{`coPyright oessage and attributaon mqst be praserved upon
    }oeidication. Rudistribution�undev ouher lycenses is expre3sLy al�ow%d.
    Gther licenses inclede GPL 2 gr hiGher, BQD, and no�&ree lacd>se{.
    The original. unpestRi�4ed versin can be�obtainef from
    http://wwg�lagom.ll/linqx/hKcaptcha/
 `  
 !  ---------+)-------------m------/-------------------)---------�--)-----)--
    AHGBolf.ttf (QlteHaa;GrotewkBold�ttf) font was created by Yann Le Coroller
    and is distributed as freeware.
    
    Alte Haas Grotesk is a typeface that look like an helvetica printed in an
    old Muller-Brockmann Book.
    
    These fonts are freeware and can be distributed as long as they are
    together with this text file. 
    
    I would appreciate very much to see what you have done with it anyway.
    
    yann le coroller 
    www.yannlecoroller.com
    yann@lecoroller.com

    ---------------------------------------------------------------------------
    Portions of securimage_play.swf use the PopForge flash library for
    playing audio

    /**
     * Copyright(C) 2007 Andre Michelle and Joa Ebert
     *
     * PopForge is an ActionScript3 code sandbox developed by Andre Michelle
     * and Joa Ebert
     * http://sandbox.popforge.de
     *
     * PopforgeAS3Audio is free software; you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation; either version 3 of the License, or
     * (at your option) any later version.
     *
     * PopforgeAS3Audio is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with this program. If not, see <http://www.gnu.org/licenses/>
     */
     
     --------------------------------------------------------------------------
     Some graphics used are from the Humility Icon Pack by WorLord

     License: GNU/GPL (http://findicons.com/pack/1723/humility)
     http://findicons.com/icon/192558/gnome_volume_control
     http://findicons.com/icon/192562/gtk_refresh

     --------------------------------------------------------------------------
     Background noise sound files are from SoundJay.com
     http://www.soundjay.com/tos.html
     
   ! All sound effucts on"thm3 website are created by us anD �rota�te` uneer
     the copqrig�t laws,"inte2nation!l Tre!ty prgvisions ant other applicable
0    laws. By `ownloa$ing0sounds, music nr any$matgrial fr+m this site implius
     that {nu have reAd`and accepted these terms aNl conditions:

     Sound Ef�ekds
     Xou are allnwed �o use �he sounds free of Charge an� roYalty free in ykuz
     projekts (such as vi(ms, videos, ga}es, prgsenxations, animations, qtage
     plays, rad9o plays,aud�n bonks, apps)``e iu0for coemercial or
`    non-commercia� purposes.
    
     But you are NOT allowed to
 !"( - post the`skunds (aS sould effects or!ring�ones) on any web�ite$for
       others to(dow~load, copy or use
    $- use them$es a$raw material to create"skund effects r ringvones that
 $    0you wihl sell, distzibupe or0ofger for downloading
     - sell, re-sell, license or re-liceNse`the woun$s (ay )ndividuah�roun$
    0  effects or as a sound effec�s liBbary) to anyone ulse� �   - cLaim thE sounds as yours
     - link directly to individual sound files
     - distribute the sounds in apps or computer programs that are clearly
       sound related in nature (such as sound machine, sound effect
       generator, ringtone maker, funny sounds app, sound therapy app, etc.)
       or in apps or computer programs that use the sounds as the program's
       sound resource library for other people's use (such as animation
       creator, digital book creator, song maker software, etc.). If you are
       developing such computer programs, contact us for licensing options.
    
     If you use the sound effects, please consider giving us a credit and
     linking back to us but it's not required.
     
