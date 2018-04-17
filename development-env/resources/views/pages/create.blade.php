@extends('layouts.app')

@section('title', 'Bookhub - Home')

@section('content')
    <!-- Content -->
    <div class="d-flex">

        <nav class="sidebar bg-dark hidden-p-md-up pb-4">
            <ul class="list-unstyled mt-4">
                <li>
                    <h5 class="text-white pl-3 pb-2 ">Categories</h5>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Arts&amp;Music</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Biographies</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Business</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Kids</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Comics</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Cooking</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Computation&amp;Tech</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Education</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Health&amp;Fitness</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        History</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Horror</a>
                </li>
                <li>
                    <a href="#submenu1" data-toggle="collapse">
                        Literature</a>
                    <ul id="submenu1" class="list-unstyled collapse">
                        <li>
                            <a href="#" class="sidebar-toggle">All</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Anthologies</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Classics</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Contemporary</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Sci-Fi&amp;Fantasy</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Romance</a>
                        </li>
                        <li>
                            <a href="#" class="sidebar-toggle">Crime</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Religion</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Science</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Self-Help</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Travel</a>
                </li>
                <li>
                    <a href="#" class="sidebar-toggle">
                        Other</a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid bg-white">
            <div class="bg-white mb-0 mt-4 pt-4 panel">
                <h4>
                    <i class="fa fa-plus"></i> Create an Auction</h4>
            </div>
            <hr id="hr_space" class="mt-2">
            <main>
                <form class="ml-4 mr-4">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Book title</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Author</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ISBN</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Publisher</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Language</label>
                            <select class="form-control" required>
                                <option value="">&nbsp;</option>
                                <option>English</option>
                                <option>Bulgarian</option>
                                <option>Croatian</option>
                                <option>Danish</option>
                                <option>Dutch</option>
                                <option>Estonian</option>
                                <option>Finnish</option>
                                <option>French</option>
                                <option>German</option>
                                <option>Greek</option>
                                <option>Hungarian</option>
                                <option>Irish</option>
                                <option>Italian</option>
                                <option>Latvian</option>
                                <option>Lithuanian</option>
                                <option>Polish</option>
                                <option>Hungarian</option>
                                <option>Romanian</option>
                                <option>Slovak</option>
                                <option>Slovenian</option>
                                <option>Spanish</option>
                                <option>Swedish</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            <select class="form-control" multiple required>
                                <option selected>Arts&amp;Music</option>
                                <option>Biographies</option>
                                <option>Business</option>
                                <option>Kids</option>
                                <option>Comics</option>
                                <option>Cooking</option>
                                <option>Computation&amp;Tech</option>
                                <option>Education</option>
                                <option>Health&amp;Fitness</option>
                                <option>History</option>
                                <option>Horror</option>
                                <optgroup label="Literature">
                                    <option>All </option>
                                    <option>Anthologies </option>
                                    <option>Classics </option>
                                    <option>Contemporary </option>
                                    <option>Sci-Fi&amp;Fantasy </option>
                                    <option>Romance </option>
                                    <option>Crime </option>
                                </optgroup>
                                <option>Religion </option>
                                <option>Science </option>
                                <option>Self-Help </option>
                                <option>Travel </option>
                                <option>Other </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea rows="3" cols="30" class="form-control" placeholder="Describe the book, its condition, or any other things you may consider important"></textarea>
                        </div>
                    </div>
                    <div class="form-row">

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Image(s) of the book</label>
                            <input id="filebutton" name="filebutton" class="form-control" type="file" multiple required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>
                                <i class="fa fa-clock"></i> Time left</label>
                            <input type="time" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control col-md-12" rows="4" cols="100" readonly>
            Bookhub Terms of Service

            1. Terms
            By accessing the website at http://bookhub.com, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.

            2. Use License
                Permission is granted to temporarily download one copy of the materials (information or software) on Bookhub's website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                    modify or copy the materials;
                    use the materials for any commercial purpose, or for any public display (commercial or non-commercial);
                    attempt to decompile or reverse engineer any software contained on Bookhub's website;
                    remove any copyright or other proprietary notations from the materials; or
                    transfer the materials to another person or "mirror" the materials on any other server.
                This license shall automatically terminate if you violate any of these restrictions and may be terminated by Bookhub at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.

            3. Disclaimer
                The materials on Bookhub's website are provided on an 'as is' basis. Bookhub makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.
                Further, Bookhub does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.

            4. Limitations
            In no event shall Bookhub or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on Bookhub's website, even if Bookhub or a Bookhub authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.

            5. Accuracy of materials
            The materials appearing on Bookhub website could include technical, typographical, or photographic errors. Bookhub does not warrant that any of the materials on its website are accurate, complete or current. Bookhub may make changes to the materials contained on its website at any time without notice. However Bookhub does not make any commitment to update the materials.

            6. Links
            Bookhub has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Bookhub of the site. Use of any such linked website is at the user's own risk.

            7. Modifications
            Bookhub may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.

            8. Governing Law
            These terms and conditions are governed by and construed in accordance with the laws of Portugal and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.
            </textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="checkbox col-md-12">
                            <label><input type="checkbox" value="checked" required> I agree with the terms of service above</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary col-md-12">Create Auction</button>
                        </div>
                    </div>
                </form>

            </main>
        </div>
    </div>

    @endsection
